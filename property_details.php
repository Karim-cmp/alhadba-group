<?php
session_start();
require 'db_connection.php';

// استلام معرف العقار من الرابط
$property_id = intval($_GET['id']);

// جلب بيانات العقار المحدد
$stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();
$property = $result->fetch_assoc();
$stmt->close();

if (!$property) {
    echo "عقار غير موجود.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $property['property_name']; ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- تأكد من ربط ملف CSS -->
</head>
<body>
    <header>
        <h1><?php echo $property['property_name']; ?></h1>
    </header>
    <div class="container">
        <img src="<?php echo $property['image_url']; ?>" alt="Property Image">
        <p><?php echo $property['description']; ?></p>
        <p>السعر: <?php echo $property['price']; ?></p>
        <p>عدد الغرف: <?php echo $property['number_of_rooms']; ?></p>
        <p>عدد الحمامات: <?php echo $property['number_of_bathrooms']; ?></p>
    </div>
</body>
</html>
