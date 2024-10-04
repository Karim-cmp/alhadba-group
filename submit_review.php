<?php
session_start();
require 'db_connection.php';

// التحقق مما إذا كان المستخدم مسجلاً دخوله
if (!isset($_SESSION['user_id'])) {
    echo "يرجى تسجيل الدخول لإضافة تعليق.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // التحقق من وجود البيانات
    if (isset($_POST['property_id'], $_POST['review'], $_POST['rating'])) {
        $property_id = intval($_POST['property_id']);
        $user_id = $_SESSION['user_id'];
        $review = htmlspecialchars(trim($_POST['review']));
        $rating = intval($_POST['rating']);

        // التحقق من صحة البيانات
        if (empty($review) || $rating < 1 || $rating > 5) {
            echo "يرجى إدخال تعليق صالح وتقييم بين 1 و 5.";
            exit;
        }

        // إعداد استعلام الإدخال
        $stmt = $conn->prepare("INSERT INTO reviews (property_id, user_id, review, rating) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            echo "خطأ في إعداد الاستعلام: " . $conn->error;
            exit;
        }

        $stmt->bind_param("iisi", $property_id, $user_id, $review, $rating);

        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            echo "تم إرسال التعليق بنجاح!";
            // يمكنك إعادة التوجيه إلى الصفحة السابقة هنا إذا أردت
            // header("Location: previous_page.php");
            // exit;
        } else {
            echo "خطأ في تنفيذ الاستعلام: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "يرجى ملء جميع الحقول.";
    }
}
?>
