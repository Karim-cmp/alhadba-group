<?php
include 'database.php';

// تحقق من أن الطلب هو POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['property_name'];
    $description = $_POST['property_description'];
    $price = $_POST['property_price'];
    $area = $_POST['property_area'];
    $image = $_FILES['property_image'];

    // تعيين مسار الصورة
    $imagePath = 'images/' . basename($image['name']);

    // نقل الصورة إلى المجلد المستهدف
    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        // التحضير للاستعلام
        $stmt = $conn->prepare("INSERT INTO properties (name, description, price, area, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $name, $description, $price, $area, $imagePath);
        
        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            echo "تم إضافة العقار بنجاح";
        } else {
            echo "حدث خطأ: " . $stmt->error;
        }
        
        // إغلاق البيان
        $stmt->close();
    } else {
        echo "حدث خطأ في تحميل الصورة.";
    }

    // إغلاق الاتصال
    $conn->close();
}
?>
