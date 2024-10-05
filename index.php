<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost"; // أو "127.0.0.1"
$username = "bobkaremkoko@gmail.com"; // اسم المستخدم الخاص بقاعدة البيانات
$password = "karimsopaih3110101"; // كلمة المرور الخاصة بقاعدة البيانات
$dbname = "اضافة عقار"; // اسم قاعدة البيانات

try {
    // إنشاء الاتصال باستخدام PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // تعيين إعدادات الخطأ
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "تم الاتصال بقاعدة البيانات بنجاح!";
} catch (PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}
?>
<!-- إضافة Bootstrap إلى ملف head -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=YOUR_TRACKING_ID"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'YOUR_TRACKING_ID');
</script>
