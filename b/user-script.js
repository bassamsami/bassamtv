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

    // التحقق من VPN أو Proxy
    fetch("https://ipinfo.io/json")
        .then(response => response.json())
        .then(data => {
            if (data.vpn || data.proxy) {
                console.error("VPN or Proxy detected!");
                alert("VPN or Proxy is not allowed!");
                window.location.href = "about:blank"; // منع الدخول بدلاً من إعادة التحميل
            }
        })
        .catch(error => console.error("Failed to check VPN/Proxy:", error));

    // التحقق من User Agent
    const userAgent = navigator.userAgent;
    if (!userAgent.includes("Mozilla") || !userAgent.includes("Chrome")) {
        console.error("Invalid user agent detected!");
        alert("Unsupported browser detected!");
        window.location.href = "about:blank"; // منع الدخول بدلاً من إعادة التحميل
    }

    // التحقق من سلامة الجلسة
    if (!localStorage.getItem("validSession")) {
        console.error("Invalid session detected!");
        localStorage.setItem("validSession", "true");
    }

    // منع Developer Tools
    (function preventDevTools() {
        const element = new Image();
        Object.defineProperty(element, "id", {
            get: function () {
                alert("Developer Tools detected!");
                window.location.href = "about:blank";
            }
        });
        console.log("%c", element);
    })();

    // منع F12, Ctrl+U, Ctrl+Shift+I
    document.addEventListener("contextmenu", e => e.preventDefault());
    document.addEventListener("keydown", e => {
        if (
            e.key === "F12" ||
            (e.ctrlKey && e.key.toLowerCase() === "u") ||
            (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === "i")
        ) {
            e.preventDefault();
            alert("Developer Tools are disabled!");
            window.location.href = "about:blank";
        }
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
                        });
                    });
                });
            });
        });
    }

    // دالة لجلب رابط البث المباشر من YouTube
    async function fetchFromYouTube(youtubeUrl) {
        try {
            const response = await fetch(youtubeUrl);
            const text = await response.text();

            // البحث عن رابط البث المباشر (Live Stream) باستخدام hlsManifestUrl
            const hlsManifestUrlMatch = text.match(/"hlsManifestUrl":"([^"]+)"/);
            if (hlsManifestUrlMatch && hlsManifestUrlMatch[1]) {
                const hlsManifestUrl = hlsManifestUrlMatch[1].replace(/\\\//g, '/'); // إصلاح الرابط
                return hlsManifestUrl;
            } else {
                console.error("لم يتم العثور على رابط البث المباشر في صفحة YouTube.");
                return null;
            }
        } catch (error) {
            console.error(`حدث خطأ أثناء جلب البيانات من الرابط: ${youtubeUrl}`, error);
            return null;
        }
    }

    // دالة لتشغيل القناة
    async function playChannel(url, key) {
        if (!url) {
            console.error("الرابط غير موجود!");
            return;
        }

        let finalUrl = url;
        let streamType = getStreamType(url);

        // إذا كان الرابط من YouTube، جلب رابط البث المباشر
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const youtubeStreamUrl = await fetchFromYouTube(url);
            if (youtubeStreamUrl) {
                finalUrl = youtubeStreamUrl;
                streamType = getStreamType(youtubeStreamUrl);
            } else {
                console.error("لم يتم العثور على رابط البث المباشر من YouTube.");
                return;
            }
        }

        // إذا لم يتم تحديد نوع الملف، لا نقوم بتشغيل الرابط
        if (!streamType) {
            console.error("نوع الملف غير مدعوم أو غير معروف:", finalUrl);
            return;
        }

        // تحويل التنسيق keyid:key إلى إعدادات DRM
        const drmConfig = key ? {
            clearkey: {
                keyId: key.split(':')[0], // الجزء الأول هو keyid
                key: key.split(':')[1]   // الجزء الثاني هو key
            },
            robustness: 'SW_SECURE_CRYPTO' // إضافة robustness
        } : null;

        // التأكد من وجود عنصر المشغل في DOM
        const playerElement = document.getElementById("player");
        if (!playerElement) {
            console.error("عنصر المشغل غير موجود في الصفحة.");
            return;
        }

        // إعداد المشغل
        try {
            const playerInstance = jwplayer("player").setup({
                playlist: [{
                    sources: [{
                        file: finalUrl,
                        type: streamType, // تحديد نوع الملف تلقائيًا
                        drm: drmConfig
                    }]
                }],
                width: "100%",
                height: "100%",
                autostart: true,
                cast: {
                    default: true // تفعيل الكاست الافتراضي
                },
                sharing: false,
                controls: true,
                stretching: "fill",
                horizontalVolumeSlider: true,
                preload: "auto",
                playbackRateControls: true,
                primary: "html5",
                mute: false,
                volume: 80,
                logo: {
                    file: "https://up6.cc/2025/03/174177781485261.png",
                    link: "https://t.me/moviball",
                    hide: false,
                    position: "bottom-left",
                    margin: 30,
                    width: 30, // حجم اللوجو الافتراضي
                    height: 30 // حجم اللوجو الافتراضي
                },
                skin: {
                    url: "https://cdn.jsdelivr.net/gh/kiprox/cf-gdplay@master/skins/netplex.css",
                    name: "Netflix"
                }
            });

            // إعداد الأحداث للمشغل
            playerInstance.on('ready', () => {
                console.log("المشغل جاهز للتشغيل");

                const logoElement = document.querySelector(".jw-logo");
                if (logoElement) {
                    logoElement.style.position = "fixed";
                    logoElement.style.bottom = "11%";
                    logoElement.style.left = "1%";
                    logoElement.style.opacity = "0";  // إخفاء اللوجو في البداية
                    logoElement.style.transition = "none"; // ظهور سريع بعد بدء البث
                }

                function updateLogoOpacity() {
                    let quality = playerInstance.getVisualQuality();
                    if (quality && quality.level) {
                        let currentHeight = quality.level.height || 480; // افتراضي 480 إذا لم تتوفر الجودة
                        let opacity = 0.2 + ((currentHeight - 240) / (1080 - 240)) * (0.8 - 0.2);

                        if (currentHeight > 1080) opacity = 0.9;

                        if (logoElement) {
                            logoElement.style.opacity = opacity.toFixed(2);
                            console.log(`الجودة الحالية: ${currentHeight}px | الشفافية: ${opacity.toFixed(2)}`);
                        }
                    }
                }

                // عند ظهور أول لقطة فيديو، نُظهر اللوجو ونضبط الشفافية
                playerInstance.on("firstFrame", function () {
                    if (logoElement) {
                        logoElement.style.opacity = "1"; // ظهور اللوجو فور تشغيل البث
                    }
                    updateLogoOpacity();
                });

                playerInstance.on("visualQuality", updateLogoOpacity);
                playerInstance.on("levelsChanged", updateLogoOpacity);
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

            playerInstance.on("fullscreen", function (event) {
                if (event.fullscreen) {
                    screen.orientation.lock("landscape").catch(() => {
                        console.warn("لم يتم دعم تأمين الشاشة في هذا المتصفح.");
                    });
                } else {
                    screen.orientation.unlock();
                }
            });
        } catch (error) {
            console.error("حدث خطأ أثناء إعداد المشغل:", error);
        }
    }

    // تحديد نوع الملف تلقائيًا
    function getStreamType(url) {
        if (url.includes(".m3u8")) {
            return "hls"; // تنسيق HLS
        } else if (url.includes(".mpd")) {
            return "dash"; // تنسيق DASH
        } else if (url.includes(".mp4") || url.includes(".m4v")) {
            return "mp4"; // تنسيق MP4
        } else if (url.includes(".ts") || url.includes(".mpegts")) {
            return "mpegts"; // تنسيق MPEG-TS
        } else {
            return null; // نوع غير معروف
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