<?php
// السماح بجميع الطلبات
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/dash+xml");
header("Content-Disposition: attachment; filename=manifest.mpd");
header("Accept-Ranges: bytes");

// تفعيل سجل الأخطاء لتصحيح أي مشكلة
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit', '256M'); // زيادة حد الذاكرة

// التأكد من تمرير الرابط
if (!isset($_GET['url'])) {
    die("Error: No URL provided.");
}

$url = $_GET['url'];

// التحقق من صحة الرابط
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    die("Error: Invalid URL provided.");
}

// استخدام cURL لجلب المحتوى
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");

// إرسال رؤوس طلب مشابهة للمتصفح
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Origin: https://tod.tv",
    "Referer: https://tod.tv",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
    "Accept: */*",
    "Accept-Encoding: gzip, deflate, br",
    "Accept-Language: en-US,en;q=0.9",
    "Connection: keep-alive"
]);

$response = curl_exec($ch);

// التحقق من أخطاء cURL
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    curl_close($ch);
    exit;
}

// التحقق من نوع الملف
$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
if (strpos($content_type, 'application/dash+xml') === false) {
    die("Error: The URL does not point to a valid DASH manifest.");
}

curl_close($ch);

// استبدال الروابط داخل ملف MPD بتمريرها عبر البروكسي
$proxy_url = "http://localhost/moviball/proxy.php?url="; // رابط البروكسي الخاص بك
$response = preg_replace('/(https?:\/\/[^\s]+\.akamaized\.net\/)/', $proxy_url . '$1', $response);

// إرسال الملف إلى المشغل
echo $response;
?>