<?php
session_start();
require 'db_connection.php';

// تحقق مما إذا كان المستخدم قد سجل الدخول
if (!isset($_SESSION['user_id'])) {
    die("يرجى تسجيل الدخول لترك تعليق.");
}

// تحقق من طلب POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استرجاع البيانات من النموذج
    $property_id = intval($_POST['property_id']);
    $user_id = $_SESSION['user_id'];
    $review = htmlspecialchars(trim($_POST['review']));
    $rating = intval($_POST['rating']);

    // التحقق من صحة البيانات
    if (empty($review) || $rating < 1 || $rating > 5) {
        echo "يرجى إدخال تقييم صحيح (من 1 إلى 5) والتأكد من أن التعليق غير فارغ.";
        exit;
    }

    // التحضير لتنفيذ الاستعلام
    $stmt = $conn->prepare("INSERT INTO reviews (property_id, user_id, review, rating) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("خطأ في الاستعلام: " . $conn->error);
    }

    // ربط المعلمات
    $stmt->bind_param("iisi", $property_id, $user_id, $review, $rating);

    // تنفيذ الاستعلام
    if ($stmt->execute()) {
        echo "تم إرسال التعليق بنجاح!";
    } else {
        echo "خطأ في إرسال التعليق: " . $stmt->error;
    }

    // إغلاق البيان
    $stmt->close();
}
?>
