<?php
$servername = "localhost";
$username = "root";  // غالبًا هيكون root لو ما غيرتش المستخدم
$password = "";      // لو ما وضعتش باسورد وقت تثبيت MySQL، سيبها فاضية
$dbname = "alhadba_group";  // اسم قاعدة البيانات اللي انت أنشأتها

// إنشاء اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL database!";
?>
