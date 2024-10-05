<?php
$servername = "localhost";
$username = "username"; // أدخل اسم المستخدم الخاص بك
$password = "password"; // أدخل كلمة المرور الخاصة بك
$dbname = "real_estate"; // أدخل اسم قاعدة البيانات الخاصة بك

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// إنشاء جدول المدونات إذا لم يكن موجودًا
$sql = "CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "تم إنشاء الجدول بنجاح";
} else {
    echo "خطأ في إنشاء الجدول: " . $conn->error;
}

// إغلاق الاتصال
$conn->close();
?>
