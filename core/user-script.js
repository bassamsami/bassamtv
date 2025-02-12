document.addEventListener("DOMContentLoaded", function() {
    // تعريف المتغيرات
    const themeToggle = document.getElementById("theme-toggle");
    const channelsList = document.getElementById("channels-list");
    const searchInput = document.getElementById("search-input");
    const clearSearch = document.getElementById("clear-search");
    const matchesButton = document.getElementById("matches-button");
    const matchesDialog = document.getElementById("matches-dialog");
    const closeDialog = document.getElementById("close-dialog");
    const toggleSidebar = document.getElementById("toggle-sidebar");
    const sidebar = document.getElementById("sidebar");

    let userTimeOffset = 0; // فارق التوقيت بين التوقيت المحلي والتوقيت العالمي

    // تبديل الثيم
    themeToggle.addEventListener("click", () => {
        document.body.classList.toggle("dark-theme");
        themeToggle.innerHTML = document.body.classList.contains("dark-theme") ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    });

    // إظهار/إخفاء القائمة الجانبية
    toggleSidebar.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
    });

    // تحميل القنوات
    function loadChannels() {
        channelsList.innerHTML = "";
        db.collection("groups").orderBy("createdAt", "asc").get().then((groupsSnapshot) => {
            groupsSnapshot.forEach((groupDoc) => {
                const group = groupDoc.data();
                const groupSection = document.createElement("div");
                groupSection.classList.add("group-section");
                groupSection.innerHTML = `<h3 class="group-name">${group.name}</h3>`;
                channelsList.appendChild(groupSection);

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
                        channelCard.setAttribute("data-key", channel.key || ""); // Key ID:Key
                        groupSection.appendChild(channelCard);

                        channelCard.addEventListener("click", () => {
                            const url = channelCard.getAttribute("data-url");
                            const key = channelCard.getAttribute("data-key");
                            playChannel(url, key);
                        });
                    });
                });
            });
        });
    }

    // تشغيل القناة
    function playChannel(url, key) {
        console.log("تشغيل القناة:", url); // فحص الرابط
        console.log("المفتاح:", key); // فحص المفتاح

        if (!url) {
            console.error("رابط القناة غير موجود!");
            return;
        }

        const config = {
            playlist: [{
                sources: [{
                    file: url,
                    type: getStreamType(url), // تحديد نوع الملف تلقائيًا
                    drm: key ? {
                        clearkey: {
                            keyId: key.split(":")[0], // keyId
                            key: key.split(":")[1],   // key
                            robustnessLevel: "SW_SECURE_CRYPTO" // تحديد مستوى أمان أعلى
                        }
                    } : null
                }]
            }],
            width: "100%",
            height: "100%",
            autostart: true,
            cast: {}, // إزالة ميزة Chromecast
            sharing: false
        };

        // إعادة تهيئة المشغل
        jwplayer("player").setup(config);
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
            return "auto"; // JW Player سيحاول تحديد النوع تلقائيًا
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
        matchesDialog.showModal();
        loadMatches();
    });

    // إغلاق جدول المباريات
    closeDialog.addEventListener("click", () => {
        matchesDialog.close();
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
                const matchTimeUTC = new Date(match.matchTime); // وقت بداية المباراة بتنسيق UTC
                const currentTimeUTC = new Date(); // الوقت الحالي بتنسيق UTC

                // حساب الفرق بين الوقت الحالي ووقت بداية المباراة
                const timeDiff = (currentTimeUTC - matchTimeUTC) / (1000 * 60); // الفرق بالدقائق

                // تحديد حالة المباراة
                let matchStatus = "";
                let matchStatusClass = "";
                if (timeDiff < -15) {
                    matchStatus = `الوقت: ${matchTimeUTC.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;
                    matchStatusClass = "match-status";
                } else if (timeDiff >= -15 && timeDiff < 0) {
                    matchStatus = "تبدأ قريبًا";
                    matchStatusClass = "match-status soon";
                } else if (timeDiff >= 0 && timeDiff < 120) { // المباراة تستمر لمدة ساعتين
                    matchStatus = "جارية الآن";
                    matchStatusClass = "match-status live";
                } else {
                    // إذا مرت ساعتان على المباراة، يتم حذفها تلقائيًا
                    db.collection("matches").doc(doc.id).delete();
                    return; // لا نعرض المباراة إذا تم حذفها
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

            // إضافة حدث لزر مشاهدة المباراة
            document.querySelectorAll(".watch-button").forEach(button => {
                button.addEventListener("click", () => {
                    const url = button.getAttribute("data-url");
                    const key = button.getAttribute("data-key");
                    playChannel(url, key);
                    matchesDialog.close(); // إغلاق الديالوج بعد الضغط على الزر
                });
            });
        });
    }

    // تحميل القنوات عند بدء التشغيل
    loadChannels();
});
