<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost"; // أو عنوان السيرفر
$username = "root"; // اسم المستخدم لقاعدة البيانات
$password = ""; // كلمة المرور لقاعدة البيانات
$dbname = "real_estate"; // اسم قاعدة البيانات

// إنشاء اتصال جديد
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    error_log("فشل الاتصال: " . $conn->connect_error); // تسجيل الخطأ في السجل
    die("فشل الاتصال بقاعدة البيانات."); // رسالة بسيطة للمستخدم
}

// يمكنك وضع الكود هنا لاستعلامات قاعدة البيانات

// لا تنس إغلاق الاتصال بعد الانتهاء
// $conn->close();
?>
