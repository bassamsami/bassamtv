document.addEventListener("DOMContentLoaded", function() {
    const themeToggle = document.getElementById("theme-toggle");
    const channelsList = document.getElementById("channels-list");
    const searchInput = document.getElementById("search-input");
    const clearSearch = document.getElementById("clear-search");
    const matchesButton = document.getElementById("matches-button");
    const playerPage = document.getElementById("player-page");
    const backButton = document.getElementById("back-button");
    const matchesPage = document.getElementById("matches-page");
    const backToChannelsFromMatches = document.getElementById("back-to-channels-from-matches");
    const channelsPage = document.getElementById("channels-page");

    let userTimeOffset = 0;
    let previousPage = "channels"; // لتتبع الصفحة السابقة (القنوات أو المباريات)

    // الكشف عن الجهاز (هاتف أو كمبيوتر)
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    // تبديل الثيم
    themeToggle.addEventListener("click", () => {
        document.body.classList.toggle("dark-theme");
        themeToggle.innerHTML = document.body.classList.contains("dark-theme") ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    });

    // تحميل القنوات
    function loadChannels() {
        channelsList.innerHTML = "";
        db.collection("groups").orderBy("createdAt", "asc").get().then((groupsSnapshot) => {
            groupsSnapshot.forEach((groupDoc) => {
                const group = groupDoc.data();
                const groupSection = document.createElement("div");
                groupSection.classList.add("group-section");
                groupSection.innerHTML = `
                    <h3 class="group-name">${group.name}</h3>
                    <div class="channels-container"></div>
                `;
                channelsList.appendChild(groupSection);

                const channelsContainer = groupSection.querySelector(".channels-container");

                db.collection("channels").where("group", "==", groupDoc.id).orderBy("createdAt", "asc").get().then((channelsSnapshot) => {
                    channelsSnapshot.forEach((channelDoc) => {
                        const channel = channelDoc.data();
                        const channelCard = document.createElement("div");
                        channelCard.classList.add("channel-card");
                        channelCard.innerHTML = `
                            <img src="${channel.image}" alt="${channel.name}">
                            <p>${channel.name}</p>
                        `;
                        channelCard.setAttribute("data-url", channel.url);
                        channelCard.setAttribute("data-key", channel.key || "");
                        channelsContainer.appendChild(channelCard);

                        channelCard.addEventListener("click", () => {
                            const url = channelCard.getAttribute("data-url");
                            const key = channelCard.getAttribute("data-key");
                            playChannel(url, key);
                            playerPage.style.display = "block";
                            channelsPage.style.display = "none";
                            previousPage = "channels"; // تحديث الصفحة السابقة
                        });
                    });
                });
            });
        });
    }

    // تشغيل القناة
    function playChannel(url, key) {
        if (!url) {
            console.error("رابط القناة غير موجود!");
            return;
        }

        const config = {
            playlist: [{
                sources: [{
                    file: url,
                    type: getStreamType(url),
                    drm: key ? {
                        clearkey: {
                            keyId: key.split(":")[0],
                            key: key.split(":")[1],
                            robustnessLevel: "SW_SECURE_CRYPTO"
                        }
                    } : null
                }]
            }],
            width: "100%",
            height: "100%",
            autostart: true,
            cast: {},
            sharing: false
        };

        const playerInstance = jwplayer("player").setup(config);

        // إذا كان الجهاز هاتف، قم بإضافة دعم للوضع الأفقي (Landscape) عند الضغط على زر تكبير الشاشة
        if (isMobile) {
            playerInstance.on('fullscreen', function(event) {
                if (event.fullscreen) {
                    screen.orientation.lock('landscape').catch(() => {
                        console.log("لم يتمكن المتصفح من قفل الشاشة في الوضع الأفقي.");
                    });
                } else {
                    screen.orientation.unlock();
                }
            });
        }
    }

    // تحديد نوع الملف تلقائيًا
    function getStreamType(url) {
        if (url.includes(".m3u8")) {
            return "hls";
        } else if (url.includes(".mpd")) {
            return "dash";
        } else if (url.includes(".mp4") || url.includes(".m4v")) {
            return "mp4";
        } else {
            return "auto";
        }
    }

    // البحث عن القنوات
    searchInput.addEventListener("input", () => {
        const searchTerm = searchInput.value.toLowerCase();
        document.querySelectorAll(".group-section").forEach((group) => {
            const groupName = group.querySelector(".group-name").textContent.toLowerCase();
            const channels = group.querySelectorAll(".channel-card");
            let hasVisibleChannels = false;

            channels.forEach((channel) => {
                const channelName = channel.querySelector("p").textContent.toLowerCase();
                if (channelName.includes(searchTerm)) {
                    channel.style.display = "flex";
                    hasVisibleChannels = true;
                } else {
                    channel.style.display = "none";
                }
            });

            group.style.display = hasVisibleChannels || groupName.includes(searchTerm) ? "block" : "none";
        });
    });

    // مسح البحث
    clearSearch.addEventListener("click", () => {
        searchInput.value = "";
        document.querySelectorAll(".group-section, .channel-card").forEach((element) => {
            element.style.display = "block";
        });
    });

    // عرض جدول المباريات
    matchesButton.addEventListener("click", () => {
        matchesPage.style.display = "block";
        channelsPage.style.display = "none";
        loadMatches();
        previousPage = "matches"; // تحديث الصفحة السابقة
    });

    // تحميل المباريات
    function loadMatches() {
        const matchesTable = document.getElementById("matches-table");
        matchesTable.innerHTML = "";

        db.collection("matches").orderBy("createdAt", "asc").get().then((querySnapshot) => {
            querySnapshot.forEach((doc) => {
                const match = doc.data();
                const matchItem = document.createElement("div");
                matchItem.classList.add("match-item");

                const team1Image = match.team1Image;
                const team2Image = match.team2Image;
                const matchTimeUTC = new Date(match.matchTime);
                const currentTimeUTC = new Date();

                const timeDiff = (currentTimeUTC - matchTimeUTC) / (1000 * 60);

                let matchStatus = "";
                let matchStatusClass = "";
                if (timeDiff < -15) {
                    matchStatus = `الوقت: ${matchTimeUTC.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;
                    matchStatusClass = "match-status";
                } else if (timeDiff >= -15 && timeDiff < 0) {
                    matchStatus = "تبدأ قريبًا";
                    matchStatusClass = "match-status soon";
                } else if (timeDiff >= 0 && timeDiff < 120) {
                    matchStatus = "جارية الآن";
                    matchStatusClass = "match-status live";
                } else {
                    db.collection("matches").doc(doc.id).delete();
                    return;
                }

                matchItem.innerHTML = `
                    <div class="teams-section">
                        <div class="team">
                            <img src="${team1Image}" alt="${match.team1}">
                            <p>${match.team1}</p>
                        </div>
                        <div class="vs-time">
                            <div class="vs">VS</div>
                            <div class="${matchStatusClass}">${matchStatus}</div>
                        </div>
                        <div class="team">
                            <img src="${team2Image}" alt="${match.team2}">
                            <p>${match.team2}</p>
                        </div>
                    </div>
                    <div class="match-details">
                        <p><span class="icon">🏆</span> ${match.matchLeague}</p>
                        <p><span class="icon">🎤</span> ${match.commentator}</p>
                    </div>
                    <button class="watch-button ${timeDiff >= -15 && timeDiff < 120 ? 'active' : 'inactive'}" data-url="${match.channelUrl}" data-key="${match.key || ''}" ${timeDiff >= -15 && timeDiff < 120 ? '' : 'disabled'}>
                        مشاهدة المباراة
                    </button>
                `;

                matchesTable.appendChild(matchItem);
            });

            document.querySelectorAll(".watch-button").forEach(button => {
                button.addEventListener("click", () => {
                    const url = button.getAttribute("data-url");
                    const key = button.getAttribute("data-key");
                    playChannel(url, key);
                    matchesPage.style.display = "none";
                    playerPage.style.display = "block";
                    previousPage = "matches"; // تحديث الصفحة السابقة
                });
            });
        });
    }

    // زر الرجوع
    backButton.addEventListener("click", () => {
        // إيقاف تشغيل القناة عند الضغط على زر الرجوع
        jwplayer("player").stop();
        playerPage.style.display = "none";
        if (previousPage === "channels") {
            channelsPage.style.display = "block";
        } else if (previousPage === "matches") {
            matchesPage.style.display = "block";
        }
    });

    // زر الرجوع من جدول المباريات
    backToChannelsFromMatches.addEventListener("click", () => {
        matchesPage.style.display = "none";
        channelsPage.style.display = "block";
    });

    // تحميل القنوات عند بدء التشغيل
    loadChannels();
});
