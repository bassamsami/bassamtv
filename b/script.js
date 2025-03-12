// تعريف المتغيرات
let currentExp = null; // لتخزين قيمة exp الحالية

// دالة لعرض ديالوج الانتظار
function showLoadingDialog(message = "جاري تحديث القنوات...") {
    const dialog = document.getElementById("loading-dialog");
    dialog.querySelector("p").textContent = message;
    dialog.style.display = "block";
}

// دالة لإخفاء ديالوج الانتظار
function hideLoadingDialog() {
    const dialog = document.getElementById("loading-dialog");
    dialog.style.display = "none";
}

// دالة لعرض ديالوج النجاح
function showSuccessDialog(message) {
    const dialog = document.getElementById("success-dialog");
    dialog.querySelector("p").textContent = message;
    dialog.style.display = "block";
    setTimeout(() => {
        dialog.style.display = "none";
    }, 2000); // إخفاء الديالوج بعد ثانيتين
}

// دالة لعرض ديالوج الخطأ
function showErrorDialog(message) {
    const dialog = document.getElementById("error-dialog");
    dialog.querySelector("p").textContent = message;
    dialog.style.display = "block";
    setTimeout(() => {
        dialog.style.display = "none";
    }, 1000); // إخفاء الديالوج بعد ثانية
}

// دالة لجلب الرابط الجديد من الموقع
async function fetchNewUrl() {
    try {
        console.log("جاري سحب الرابط من الموقع...");
        const response = await fetch('https://alraqi-tv.com/AAAA/2025//api.php');
        const newUrl = await response.text(); // الحصول على النص مباشرةً
        console.log("تم سحب الرابط بنجاح:", newUrl);

        // التحقق من أن الرابط صالح
        if (newUrl && newUrl.startsWith("http")) {
            return newUrl.trim(); // إرجاع الرابط بعد إزالة أي مسافات زائدة
        } else {
            throw new Error("الرابط الذي تم الحصول عليه غير صالح.");
        }
    } catch (error) {
        console.error("حدث خطأ أثناء جلب الرابط الجديد:", error);
        return null;
    }
}

// دالة لتحديث الروابط بناءً على رابط جديد
async function updateLinksWithNewUrl(newUrl) {
    try {
        console.log("جاري تحديث الروابط باستخدام الرابط الجديد:", newUrl);

        // استخراج القيم الجديدة من الرابط
        const stMatch = newUrl.match(/st=(\d+)/);
        const expMatch = newUrl.match(/exp=(\d+)/);
        const dataMatch = newUrl.match(/data=([a-f0-9-]+)/);
        const hmacMatch = newUrl.match(/hmac=([a-f0-9]+)/);

        if (stMatch && expMatch && dataMatch && hmacMatch) {
            const newSt = stMatch[1];
            const newExp = parseInt(expMatch[1], 10); // تحويل exp إلى عدد صحيح
            const newData = dataMatch[1];
            const newHmac = hmacMatch[1];

            console.log("تم استخراج القيم الجديدة:", { newSt, newExp, newData, newHmac });

            // تحديد نوع التحديث بناءً على الرابط
            if (newUrl.includes("acl=/Content/*")) {
                // تحديث الروابط التي تحتوي على `acl=/Content/*`
                console.log("تحديث الروابط التي تحتوي على `acl=/Content/*`...");
                await updateCollectionLinks("channels", newSt, newExp, newData, newHmac, "acl=/Content/*");
                await updateCollectionLinks("matches", newSt, newExp, newData, newHmac, "acl=/Content/*");
            } else if (newUrl.includes("variant/v1blackout/spo-hd-38-d-shortdvr")) {
                // تحديث الروابط التي تحتوي على `variant/v1blackout/spo-hd-38-d-shortdvr`
                console.log("تحديث الروابط التي تحتوي على `variant/v1blackout/spo-hd-38-d-shortdvr`...");
                await updateCollectionLinks("channels", newSt, newExp, newData, newHmac, "variant/v1blackout/spo-hd-38-d-shortdvr");
                await updateCollectionLinks("matches", newSt, newExp, newData, newHmac, "variant/v1blackout/spo-hd-38-d-shortdvr");
            }

            console.log("تم تحديث جميع الروابط بنجاح!");
            showSuccessDialog("تم تحديث جميع الروابط بنجاح!");

            // إرجاع قيمة exp لاستخدامها في المراقبة
            return newExp;
        } else {
            throw new Error("الرابط الجديد لا يحتوي على جميع القيم المطلوبة (st, exp, data, hmac).");
        }
    } catch (error) {
        console.error("حدث خطأ أثناء تحديث الروابط:", error);
        showErrorDialog("حدث خطأ أثناء تحديث الروابط: " + error.message);
        return null;
    }
}

// دالة لحساب الوقت المتبقي
function getTimeRemaining(exp) {
    const currentTime = Math.floor(Date.now() / 1000); // الوقت الحالي بتنسيق Unix time
    const timeRemaining = exp - currentTime; // الوقت المتبقي حتى انتهاء الصلاحية
    return timeRemaining > 0 ? timeRemaining : 0; // إرجاع الوقت المتبقي أو 0 إذا انتهى الوقت
}

// دالة لمراقبة الوقت المتبقي
function monitorExpiration() {
    if (currentExp) {
        const timeRemaining = getTimeRemaining(currentExp); // حساب الوقت المتبقي
        if (timeRemaining > 0) {
            console.log(`سيتم التحديث تلقائيًا بعد ${timeRemaining} ثانية...`);
            setTimeout(async () => {
                await autoUpdate(); // تنفيذ التحديث عند انتهاء الوقت
                monitorExpiration(); // الاستمرار في المراقبة
            }, timeRemaining * 1000);
        } else {
            console.log("انتهت صلاحية الرابط، يتم التحديث الآن...");
            autoUpdate(); // تحديث فوري إذا انتهت الصلاحية
            monitorExpiration(); // الاستمرار في المراقبة
        }
    }
}

// دالة رئيسية للتحديث
async function autoUpdate() {
    console.log("بدء التحديث...");
    showLoadingDialog("جاري تحديث القنوات...");
    const newUrl = await fetchNewUrl();
    if (newUrl) {
        const exp = await updateLinksWithNewUrl(newUrl);
        if (exp) {
            currentExp = exp; // تحديث قيمة exp الحالية
        }
    } else {
        console.error("لم يتم العثور على رابط جديد.");
        showErrorDialog("لم يتم العثور على رابط جديد.");
    }
    hideLoadingDialog(); // إخفاء ديالوج الانتظار بعد الانتهاء
}

// ربط الزر بالدالة
document.addEventListener("DOMContentLoaded", () => {
    const updateButton = document.getElementById("update-button");
    updateButton.addEventListener("click", async () => {
        console.log("تم الضغط على الزر، بدء التحديث...");
        await autoUpdate(); // تنفيذ التحديث لأول مرة
        monitorExpiration(); // بدء مراقبة الوقت المتبقي
        updateButton.disabled = true; // تعطيل الزر بعد الضغط عليه
    });
});