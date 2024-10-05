<?php
// بدء الجلسة
session_start();

// التأكد من أن المستخدم مسجل دخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // الحصول على ID المستخدم

// الاتصال بقاعدة البيانات
include 'database.php';

// التحقق من وجود بيانات تم إرسالها
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // الحصول على بيانات العقار من النموذج
    $property_title = $_POST['title'];
    $property_description = $_POST['description'];
    $property_price = $_POST['price'];
    $property_location = $_POST['location'];

    // التحقق من أن البيانات ليست فارغة
    if (empty($property_title) || empty($property_description) || empty($property_price) || empty($property_location)) {
        echo "يرجى ملء جميع الحقول المطلوبة.";
        exit();
    }

    // إدخال بيانات العقار في جدول `properties`
    $sql = "INSERT INTO properties (user_id, title, description, price, location) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issss', $user_id, $property_title, $property_description, $property_price, $property_location);

    if ($stmt->execute()) {
        $property_id = $stmt->insert_id; // الحصول على ID العقار الجديد

        // مسار مجلد الصور
        $image_upload_path = 'uploads/';
        if (!file_exists($image_upload_path)) {
            mkdir($image_upload_path, 0777, true); // إنشاء المجلد إذا لم يكن موجودًا
        }

        // التحقق من رفع الصور
        if (isset($_FILES['property_images'])) {
            $total_images = count($_FILES['property_images']['name']);
            for ($i = 0; $i < $total_images && $i < 100; $i++) {
                $image_name = $_FILES['property_images']['name'][$i];
                $image_tmp_name = $_FILES['property_images']['tmp_name'][$i];

                // التأكد من أن الملف هو صورة
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                if (in_array(strtolower($image_extension), $allowed_extensions)) {
                    $new_image_name = uniqid("IMG_", true) . '.' . $image_extension;
                    $image_destination = $image_upload_path . $new_image_name;

                    // نقل الصورة إلى المجلد
                    if (move_uploaded_file($image_tmp_name, $image_destination)) {
                        // حفظ مسار الصورة في قاعدة البيانات
                        $image_sql = "INSERT INTO property_images (property_id, image_path) VALUES (?, ?)";
                        $image_stmt = $conn->prepare($image_sql);
                        $image_stmt->bind_param('is', $property_id, $new_image_name); // حفظ اسم الصورة فقط في قاعدة البيانات
                        $image_stmt->execute();
                    }
                }
            }
        }

        echo "تم إضافة العقار بنجاح!";
    } else {
        echo "حدث خطأ: " . $conn->error;
    }

    // غلق الاتصال
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة عقار</title>
</head>
<body>
    <h2>إضافة عقار جديد</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="title">عنوان العقار:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">وصف العقار:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="price">سعر العقار:</label>
        <input type="number" id="price" name="price" required><br>

        <label for="location">موقع العقار:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="property_images">رفع الصور (يمكنك رفع حتى 100 صورة):</label>
        <input type="file" name="property_images[]" multiple accept="image/*"><br>

        <button type="submit">إضافة العقار</button>
    </form>
</body>
</html>
