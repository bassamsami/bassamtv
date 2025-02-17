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

    // إذا كان الرابط يحتوي على رابطين (PHP & Worker)
    const urls = url.split('&').map(u => u.trim()); // فصل الرابطين

    for (const currentUrl of urls) {
        try {
            // إذا كان الرابط من YouTube
            if (currentUrl.includes("youtube.com/watch")) {
                const response = await fetch(currentUrl); // جلب محتوى الصفحة
                const text = await response.text();

                // البحث عن رابط البث المباشر (Live Stream)
                const hlsManifestUrlMatch = text.match(/"hlsManifestUrl":"([^"]+)"/);
                if (hlsManifestUrlMatch && hlsManifestUrlMatch[1]) {
                    finalUrl = hlsManifestUrlMatch[1].replace(/\\\//g, '/'); // إصلاح الرابط
                    console.log("تم سحب رابط البث المباشر من YouTube:", finalUrl);
                    break;
                } 
                // إذا لم يكن بثًا مباشرًا، البحث عن رابط الفيديو العادي
                else {
                    const serverAbrStreamingUrlMatch = text.match(/"serverAbrStreamingUrl":"([^"]+)"/);
                    if (serverAbrStreamingUrlMatch && serverAbrStreamingUrlMatch[1]) {
                        finalUrl = serverAbrStreamingUrlMatch[1].replace(/\\\//g, '/'); // إصلاح الرابط
                        console.log("تم سحب رابط الفيديو العادي من YouTube:", finalUrl);
                        break;
                    }
                }
            }

            // إذا كان الرابط ينتهي بـ .php
            if (currentUrl.endsWith('.php')) {
                const response = await fetch(currentUrl);
                const text = await response.text();

                // البحث عن الوسم manifestUri = "
                const manifestUriMatch = text.match(/manifestUri\s*=\s*["']([^"']+)["']/);
                if (manifestUriMatch && manifestUriMatch[1]) {
                    finalUrl = manifestUriMatch[1];
                    console.log("تم سحب الرابط من manifestUri:", finalUrl);
					// استخدام المفاتيح الثابتة
                const staticKeyid = "0a7934dddc3136a6922584b96c3fd1e5";
                const staticKey = "676e6d1dd00bfbe266003efaf0e3aa02";
                finalKey = `${staticKeyid}:${staticKey}`; // استخدام المفاتيح الثابتة
                console.log("تم استخدام المفاتيح الثابتة:", finalKey);
                    
                    break;
                }

                // البحث عن الوسم file: "
                const fileMatch = text.match(/file:\s*["']([^"']+)["']/);
                if (fileMatch && fileMatch[1]) {
                    finalUrl = fileMatch[1];
                    console.log("تم سحب الرابط من file:", finalUrl);
					// استخدام المفاتيح الثابتة
                const staticKeyid = "0a7934dddc3136a6922584b96c3fd1e5";
                const staticKey = "676e6d1dd00bfbe266003efaf0e3aa02";
                finalKey = `${staticKeyid}:${staticKey}`; // استخدام المفاتيح الثابتة
                console.log("تم استخدام المفاتيح الثابتة:", finalKey);
                    
                    break;
                }
            }

            // إذا كان الرابط من Worker
            if (currentUrl.includes("workers.dev")) {
                const response = await fetch(currentUrl);
                const data = await response.json();

                // استخدام stream_url إذا كان موجودًا
                if (data.stream_url) {
                    finalUrl = data.stream_url;
                    console.log("تم سحب رابط البث من Worker:", finalUrl);
					// استخدام المفاتيح الثابتة
                const staticKeyid = "0a7934dddc3136a6922584b96c3fd1e5";
                const staticKey = "676e6d1dd00bfbe266003efaf0e3aa02";
                finalKey = `${staticKeyid}:${staticKey}`; // استخدام المفاتيح الثابتة
                console.log("تم استخدام المفاتيح الثابتة:", finalKey);
                    
                    break;
                }
            }

            // إذا كان الرابط مباشرًا (MPD أو M3U8)
            if (currentUrl.endsWith('.mpd') || currentUrl.endsWith('.m3u8')) {
                finalUrl = currentUrl; // استخدام الرابط مباشرة
                console.log("تم استخدام رابط البث المباشر:", finalUrl);
                break;
            }
        } catch (error) {
            console.error(`حدث خطأ أثناء جلب البيانات من الرابط: ${currentUrl}`, error);
        }
    }

    // إذا لم يتم سحب أي رابط، نستخدم الرابط الأصلي
    if (!finalUrl) {
        finalUrl = url;
        console.log("تم استخدام الرابط الأصلي:", finalUrl);
    }

    // إذا تمت إضافة مفتاح جديد يدويًا (بالطريقة التقليدية)، استخدامه بدلاً من المفاتيح الثابتة
    if (key) {
        finalKey = key; // استخدام المفتاح الجديد
        console.log("تم استخدام المفتاح الجديد:", finalKey);
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

    // إعداد الأحداث للمشغل
    playerInstance.on('ready', () => {
        console.log("المشغل جاهز للتشغيل!");
    });

    playerInstance.on('error', (error) => {
        console.error("حدث خطأ في المشغل:", error);
        if (error.code === 246012) {
            console.error("السبب المحتمل: الرابط أو المفاتيح غير صحيحة.");
        }
    });

    playerInstance.on('setupError', (error) => {
        console.error("حدث خطأ في إعداد المشغل:", error);
    });
}

async function fetchManifestAndKeys(phpUrl) {
    try {
        const response = await fetch(phpUrl);
        const text = await response.text(); // جلب محتوى الصفحة كـ نص

        // البحث عن الوسم manifestUri = "
        const manifestUriMatch = text.match(/manifestUri\s*=\s*["']([^"']+)["']/);
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