document.addEventListener("DOMContentLoaded", function () {
    // وظيفة لتطبيق object-fit: cover على الفيديو
function applyObjectFit() {
    const videoElement = document.querySelector('#player video');
    if (videoElement) {
        videoElement.style.objectFit = 'cover'; // ملء الحاوية مع الاقتصاص
        videoElement.style.width = '100%'; // إجبار العرض على 100%
        videoElement.style.height = '100%'; // إجبار الارتفاع على 100%
    }
}

// مراقبة التغييرات على عنصر الفيديو
function observeVideoElement() {
    const targetNode = document.querySelector('#player');
    if (targetNode) {
        const observer = new MutationObserver(function(mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'childList' || mutation.type === 'attributes') {
                    applyObjectFit(); // إعادة تطبيق object-fit عند أي تغيير
                }
            }
        });

        // بدء المراقبة
        observer.observe(targetNode, { 
            childList: true, // مراقبة التغييرات في العناصر الفرعية
            attributes: true // مراقبة التغييرات في السمات
        });
    }
}

// تطبيق object-fit عند تحميل المشغل
playerInstance.on('ready', function() {
    applyObjectFit(); // التطبيق الأولي
    observeVideoElement(); // بدء مراقبة التغييرات
});

// إعادة تطبيق object-fit عند تغيير حجم النافذة
window.addEventListener('resize', function() {
    applyObjectFit();
});

// إعادة تطبيق object-fit كل ثانية كـ backup
setInterval(function() {
    applyObjectFit();
}, 1000);

// مراقبة أحداث الشاشة الكاملة
document.addEventListener('fullscreenchange', function() {
    applyObjectFit(); // تطبيق object-fit عند الدخول أو الخروج من الشاشة الكاملة
});

document.addEventListener('webkitfullscreenchange', function() {
    applyObjectFit(); // للتأكد من التوافق مع متصفحات WebKit (مثل Safari)
});

document.addEventListener('mozfullscreenchange', function() {
    applyObjectFit(); // للتأكد من التوافق مع Firefox
});

document.addEventListener('MSFullscreenChange', function() {
    applyObjectFit(); // للتأكد من التوافق مع Internet Explorer
});
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
    const errorDialog = document.getElementById("error-dialog");
    const closeErrorDialog = document.getElementById("close-error-dialog");

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

    // إظهار ديالوج الخطأ
    function showErrorDialog(message) {
        const errorMessage = document.getElementById("error-message");
        errorMessage.textContent = message;
        errorDialog.style.display = "block";
    }

    // إغلاق ديالوج الخطأ
    closeErrorDialog.addEventListener("click", () => {
        errorDialog.style.display = "none";
    });

    // دالة لجلب manifestUri و clearkeys من ملف PHP
    async function playChannel(url, key) {
    if (!url) {
        console.error("رابط القناة غير موجود!");
        showErrorDialog("رابط القناة غير موجود!");
        return;
    }

    let finalUrl = url;
    let finalKey = key;

    // إذا كان الرابط يحتوي على رابطين (PHP & Worker)
    const urls = url.split('&').map(u => u.trim()); // فصل الرابطين

    // المفاتيح الثابتة
    const staticKeyid = "0a7934dddc3136a6922584b96c3fd1e5";
    const staticKey = "676e6d1dd00bfbe266003efaf0e3aa02";
    const staticKeyCombined = `${staticKeyid}:${staticKey}`;

    // دالة لسحب الرابط من PHP
    async function fetchFromPHP(phpUrl) {
        try {
            const response = await fetch(phpUrl);
            const text = await response.text();

            // البحث عن الوسم manifestUri = "
            const manifestUriMatch = text.match(/manifestUri\s*=\s*["']([^"']+)["']/);
            if (manifestUriMatch && manifestUriMatch[1]) {
                console.log("تم استخدام المفاتيح الثابتة:", staticKeyCombined);
                return {
                    url: manifestUriMatch[1],
                    key: staticKeyCombined // استخدام المفاتيح الثابتة
                };
            }

            // البحث عن الوسم file: "
            const fileMatch = text.match(/file:\s*["']([^"']+)["']/);
            if (fileMatch && fileMatch[1]) {
                console.log("تم استخدام المفاتيح الثابتة:", staticKeyCombined);
                return {
                    url: fileMatch[1],
                    key: staticKeyCombined // استخدام المفاتيح الثابتة
                };
            }
        } catch (error) {
            console.error(`حدث خطأ أثناء جلب البيانات من الرابط: ${phpUrl}`, error);
        }
        return null;
    }

    // دالة لسحب الرابط من Worker
    async function fetchFromWorker(workerUrl) {
        try {
            const response = await fetch(workerUrl);
            const data = await response.json();

            // استخدام stream_url إذا كان موجودًا
            if (data.stream_url) {
                console.log("تم استخدام المفاتيح الثابتة:", staticKeyCombined);
                return {
                    url: data.stream_url,
                    key: staticKeyCombined // استخدام المفاتيح الثابتة
                };
            }
        } catch (error) {
            console.error(`حدث خطأ أثناء جلب البيانات من الرابط: ${workerUrl}`, error);
        }
        return null;
    }

    // إذا كان الرابط يحتوي على رابطين (PHP & Worker)، نقوم بجلب البيانات
    if (urls.length > 1) {
        const [phpUrl, workerUrl] = urls;

        // جرب سحب الرابطين في نفس الوقت
        const [phpResult, workerResult] = await Promise.all([
            fetchFromPHP(phpUrl),
            fetchFromWorker(workerUrl)
        ]);

        // استخدام الرابط الذي يعمل أولاً
        if (phpResult) {
            finalUrl = phpResult.url;
            finalKey = phpResult.key;
            console.log("تم سحب الرابط من PHP:", finalUrl);
        } else if (workerResult) {
            finalUrl = workerResult.url;
            finalKey = workerResult.key;
            console.log("تم سحب الرابط من Worker:", finalUrl);
        } else {
            // إذا فشل الرابطان
            console.error("لم يتم سحب أي رابط يعمل.");
            showErrorDialog("لم يتم تحديث القناة حتى الآن، يرجى المحاولة لاحقًا.");
            return;
        }
    } else {
        // إذا كان الرابط مباشرًا (مثل mpd أو m3u8)، نستخدمه مباشرة
        finalUrl = url;
        console.log("تم استخدام الرابط المباشر:", finalUrl);
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

    // تحديد نوع الملف بشكل صحيح
    const streamType = getStreamType(finalUrl);

    // إعداد المشغل
    const playerInstance = jwplayer("player").setup({
        playlist: [{
            sources: [{
                file: finalUrl,
                type: streamType,
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

    playerInstance.on('error', async (error) => {
        console.error("حدث خطأ في المشغل:", error);

        // إذا كان الرابط يحتوي على رابطين، جرب الرابط الآخر
        if (urls.length > 1) {
            const [phpUrl, workerUrl] = urls;

            if (finalUrl === phpResult?.url) {
                // إذا كان الرابط الأول هو الذي فشل، جرب الرابط الثاني
                const workerResult = await fetchFromWorker(workerUrl);

                if (workerResult) {
                    finalUrl = workerResult.url;
                    finalKey = workerResult.key;
                    console.log("تم التبديل إلى الرابط من Worker:", finalUrl);

                    // إعادة تحميل المشغل بالرابط الجديد
                    playerInstance.load([{
                        file: finalUrl,
                        type: getStreamType(finalUrl),
                        drm: drmConfig
                    }]);
                } else {
                    showErrorDialog("لم يتم تحديث القناة حتى الآن، يرجى المحاولة لاحقًا.");
                }
            } else if (finalUrl === workerResult?.url) {
                // إذا كان الرابط الثاني هو الذي فشل، جرب الرابط الأول
                const phpResult = await fetchFromPHP(phpUrl);

                if (phpResult) {
                    finalUrl = phpResult.url;
                    finalKey = phpResult.key;
                    console.log("تم التبديل إلى الرابط من PHP:", finalUrl);

                    // إعادة تحميل المشغل بالرابط الجديد
                    playerInstance.load([{
                        file: finalUrl,
                        type: getStreamType(finalUrl),
                        drm: drmConfig
                    }]);
                } else {
                    showErrorDialog("لم يتم تحديث القناة حتى الآن، يرجى المحاولة لاحقًا.");
                }
            }
        } else {
            showErrorDialog("حدث خطأ في تشغيل القناة. يرجى التحقق من الرابط والمفتاح.");
        }
    });

    playerInstance.on('setupError', (error) => {
        console.error("حدث خطأ في إعداد المشغل:", error);
        showErrorDialog("حدث خطأ في إعداد المشغل. يرجى التحقق من الرابط والمفتاح.");
    });

    // جعل المشغل يأخذ العرض الكامل عند التكبير
    playerInstance.on('fullscreen', function(event) {
        if (event.fullscreen) {
            playerContainer.style.width = "100%";
            playerContainer.style.height = "100%";
        } else {
            playerContainer.style.width = "100%";
            playerContainer.style.height = "80vh";
        }
    });
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
