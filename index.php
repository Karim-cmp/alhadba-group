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
