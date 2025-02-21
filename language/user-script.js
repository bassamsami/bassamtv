document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("theme-toggle");
    const channelsList = document.getElementById("channels-list");
    const searchInput = document.getElementById("search-input");
    const clearSearch = document.getElementById("clear-search");
    const matchesButton = document.getElementById("matches-button");
    const playerContainer = document.getElementById("player-container");
    const playerPlaceholder = document.getElementById("player-placeholder");
    const channelsSidebar = document.getElementById("channels-sidebar");
    const channelsToggle = document.getElementById("channels-toggle");
    const closeSidebar = document.getElementById("close-sidebar");
    const matchesDialog = document.getElementById("matches-dialog");
    const closeMatchesDialog = document.getElementById("close-matches-dialog");

    // إخفاء القائمة عند النقر خارجها
    document.addEventListener("click", (event) => {
        if (!channelsSidebar.contains(event.target) && !channelsToggle.contains(event.target)) {
            channelsSidebar.style.display = "none";
        }
    });

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
                groupSection.setAttribute("data-group-id", groupDoc.id);
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
                            channelsSidebar.style.display = "none";
                            playerPlaceholder.style.display = "none";
                        });
                    });
                });
            });
        });
    }

    // دالة لجلب manifestUri و clearkeys من ملف PHP
async function playChannel(url, key) {
    if (!url) {
        console.error("رابط القناة غير موجود!");
        return;
    }

    let finalUrl = url;
    let finalKey = key;

    // قائمة بالوسائط المتاحة
    const proxies = [
        'https://cors-anywhere.herokuapp.com/',
        'https://api.allorigins.win/raw?url=',
        'https://thingproxy.freeboard.io/fetch/',
        'https://corsproxy.io/'
    ];

    // دالة لاختبار الوسائط
    async function testProxies(url) {
        for (const proxy of proxies) {
            try {
                const proxyUrl = proxy + encodeURIComponent(url);
                const response = await fetch(proxyUrl, { method: 'HEAD' });
                if (response.ok) {
                    return proxyUrl; // إذا نجح الوسيط، نعيد الرابط
                }
            } catch (error) {
                console.error(`فشل الوسيط: ${proxy}`, error);
            }
        }
        return null; // إذا فشلت جميع الوسائط
    }

    // إذا كان الرابط يحتاج إلى وسيط (CORS محمي)
    if (url.startsWith('http') && !url.includes('cors-anywhere') && !url.includes('allorigins')) {
        const proxyUrl = await testProxies(url);
        if (proxyUrl) {
            finalUrl = proxyUrl; // استخدام الوسيط الناجح
        } else {
            console.error("فشل جميع الوسائط في تجاوز CORS.");
            return;
        }
    }

    // إذا كان الرابط ينتهي بـ .php، جلب البيانات منه
    if (url.endsWith('.php')) {
        const { manifestUri } = await fetchManifestAndKeys(url);
        if (manifestUri) {
            finalUrl = manifestUri; // استخدام الرابط المسحوب

            // استخدام المفاتيح الثابتة عند سحبها من ملف الـ .php
            const staticKeyid = "0a7934dddc3136a6922584b96c3fd1e5";
            const staticKey = "676e6d1dd00bfbe266003efaf0e3aa02";
            finalKey = `${staticKeyid}:${staticKey}`; // استخدام المفاتيح الثابتة
        } else {
            console.error("لم يتم العثور على رابط البث في ملف PHP.");
            return;
        }
    }

    // إذا تمت إضافة مفتاح جديد يدويًا (بالطريقة التقليدية)، استخدامه بدلاً من المفاتيح الثابتة
    if (key) {
        finalKey = key; // استخدام المفتاح الجديد
    }

    // دالة لسحب رابط البث المباشر من YouTube
    async function fetchFromYouTube(youtubeUrl) {
        try {
            const response = await fetch(youtubeUrl);
            const text = await response.text();

            // البحث عن رابط البث المباشر (Live Stream)
            const hlsManifestUrlMatch = text.match(/"hlsManifestUrl":"([^"]+)"/);
            if (hlsManifestUrlMatch && hlsManifestUrlMatch[1]) {
                return hlsManifestUrlMatch[1].replace(/\\\//g, '/'); // إصلاح الرابط
            }
        } catch (error) {
            console.error(`حدث خطأ أثناء جلب البيانات من الرابط: ${youtubeUrl}`, error);
        }
        return null;
    }

    // تحويل التنسيق keyid:key إلى إعدادات DRM
    const drmConfig = finalKey ? {
        clearkey: {
            keyId: finalKey.split(':')[0], // الجزء الأول هو keyid
            key: finalKey.split(':')[1]   // الجزء الثاني هو key
        },
        robustness: 'SW_SECURE_CRYPTO' // إضافة robustness
    } : null;

    // إعداد المشغل
    const playerInstance = jwplayer("player").setup({
        playlist: [{
            sources: [{
                file: finalUrl,
                type: getStreamType(finalUrl),
                drm: drmConfig
            }]
        }],
        width: "100%",
        height: "100%",
        autostart: true,
        cast: {},
        sharing: false
    });

    // إظهار اللوجو الشخصي عند بدء التشغيل
    playerInstance.on('ready', () => {
        console.log("المشغل جاهز للتشغيل!");
        document.getElementById("personal-logo").style.display = "block"; // إظهار اللوجو الشخصي
    });

    // إخفاء اللوجو الشخصي عند حدوث خطأ
    playerInstance.on('error', (error) => {
        console.error("حدث خطأ في المشغل:", error);
        document.getElementById("personal-logo").style.display = "none"; // إخفاء اللوجو الشخصي

        if (error.code === 246012) {
            console.error("السبب المحتمل: الرابط أو المفاتيح غير صحيحة.");
        }
    });

    // إدارة وضع Fullscreen
    playerInstance.on('fullscreen', (event) => {
        const logo = document.getElementById("personal-logo");
        if (event.fullscreen) {
            logo.classList.add("fullscreen"); // إضافة كلاس Fullscreen
        } else {
            logo.classList.remove("fullscreen"); // إزالة كلاس Fullscreen
        }
    });

    // إخفاء اللوجو الشخصي عند إيقاف التشغيل
    playerInstance.on('complete', () => {
        document.getElementById("personal-logo").style.display = "none"; // إخفاء اللوجو الشخصي
    });

    playerInstance.on('setupError', (error) => {
        console.error("حدث خطأ في إعداد المشغل:", error);
    });
}

// دالة لاستخراج رابط البث من ملف PHP
async function fetchManifestAndKeys(phpUrl) {
    try {
        const response = await fetch(phpUrl);
        const text = await response.text();

        // استخراج رابط الـ manifestUri
        const manifestUriMatch = text.match(/const manifestUri\s*=\s*["']([^"']+)["']/);
        const manifestUri = manifestUriMatch ? manifestUriMatch[1] : null;

        return { manifestUri };
    } catch (error) {
        console.error("حدث خطأ أثناء جلب البيانات من ملف PHP:", error);
        return { manifestUri: null };
    }
}

// دالة لتحديد نوع الملف تلقائيًا
function getStreamType(url) {
    if (url.includes(".m3u8")) {
        return "hls";
    } else if (url.includes(".mpd")) {
        return "dash";
    } else if (url.includes(".mp4") || url.includes(".m4v")) {
        return "mp4";
    } else if (url.includes(".ts") || url.includes(".mpegts")) {
        return "mpegts";
    } else if (url.includes(".php") || url.includes(".embed")) {
        return "html5";
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

    // عرض قائمة القنوات
    channelsToggle.addEventListener("click", () => {
        channelsSidebar.style.display = "block";
    });

    // إغلاق قائمة القنوات
    closeSidebar.addEventListener("click", () => {
        channelsSidebar.style.display = "none";
    });

    // عرض ديالوج المباريات
    matchesButton.addEventListener("click", () => {
        matchesDialog.style.display = "block";
        loadMatches();
    });

    // إغلاق ديالوج المباريات
    closeMatchesDialog.addEventListener("click", () => {
        matchesDialog.style.display = "none";
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
                    matchesDialog.style.display = "none";
                    playerPlaceholder.style.display = "none";
                });
            });
        });
    }

    // تحميل القنوات عند بدء التشغيل
    loadChannels();
});
