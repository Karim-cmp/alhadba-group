<?php
session_start();
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $property_name = htmlspecialchars($_POST['property_name']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    $number_of_rooms = intval($_POST['number_of_rooms']);
    $number_of_bathrooms = intval($_POST['number_of_bathrooms']);
    $image_url = htmlspecialchars($_POST['image_url']);

    // إدراج البيانات في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO properties (property_name, description, price, number_of_rooms, number_of_bathrooms, image_url) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiis", $property_name, $description, $price, $number_of_rooms, $number_of_bathrooms, $image_url);

    if ($stmt->execute()) {
        echo "تم إضافة العقار بنجاح!";
    } else {
        echo "خطأ: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة عقار</title>
    <link rel="stylesheet" href="styles.css"> <!-- تأكد من ربط ملف CSS -->
</head>
<body>
    <header>
        <h1>إضافة عقار جديد</h1>
    </header>
    <form action="" method="POST">
        <input type="text" name="property_name" placeholder="اسم العقار" required>
        <textarea name="description" placeholder="وصف العقار" required></textarea>
        <input type="number" name="price" placeholder="السعر" required>
        <input type="number" name="number_of_rooms" placeholder="عدد الغرف" required>
        <input type="number" name="number_of_bathrooms" placeholder="عدد الحمامات" required>
        <input type="text" name="image_url" placeholder="رابط الصورة" required>
        <button type="submit">إضافة العقار</button>
    </form>
</body>
<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost"; // أو "127.0.0.1"
$username = "bobkaremkoko@gmail.com"; // اسم المستخدم
$password = "karimsopaih3110101"; // كلمة المرور
$dbname = "اضافة عقار"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// إضافة عقار
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property_name = htmlspecialchars($_POST['property_name']);
    $property_type = htmlspecialchars($_POST['property_type']);
    $location = htmlspecialchars($_POST['location']);
    $price = floatval($_POST['price']);
    $number_of_bedrooms = intval($_POST['number_of_bedrooms']);
    $number_of_bathrooms = intval($_POST['number_of_bathrooms']);
    $description = htmlspecialchars($_POST['description']);

    $stmt = $conn->prepare("INSERT INTO properties (property_name, property_type, location, price, number_of_bedrooms, number_of_bathrooms, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdiss", $property_name, $property_type, $location, $price, $number_of_bedrooms, $number_of_bathrooms, $description);

    if ($stmt->execute()) {
        echo "تم إضافة العقار بنجاح!";
    } else {
        echo "خطأ: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

