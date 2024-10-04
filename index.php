<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost"; // أو "127.0.0.1"
$username = "bobkaremkoko@gmail.com"; // اسم المستخدم الخاص بقاعدة البيانات
$password = "karimsopaih3110101"; // كلمة المرور الخاصة بقاعدة البيانات
$dbname = "اضافة عقار"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
echo "تم الاتصال بقاعدة البيانات بنجاح!";
?>
