<?php
$servername = "localhost";
$username = "root"; // استخدم اسم المستخدم الخاص بك
$password = ""; // استخدم كلمة المرور الخاصة بك
$dbname = "الهضبة جروب Alhadba Group"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استعلام لاسترجاع جميع العقارات
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // عرض البيانات لكل عقار
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Title: " . $row["title"] . " - Description: " . $row["description"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
