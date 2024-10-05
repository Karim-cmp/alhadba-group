<?php
include 'database.php'; // تضمين ملف الاتصال بقاعدة البيانات

// تنفيذ استعلام لجلب جميع العقارات
$result = $conn->query("SELECT * FROM properties");

$properties = []; // مصفوفة لتخزين نتائج العقارات

// تحقق مما إذا كانت هناك نتائج
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row; // إضافة كل صف إلى المصفوفة
    }
} else {
    // في حالة عدم وجود نتائج، يمكنك إضافة رسالة أو معالجتها كما تراه مناسبًا
    echo json_encode(["message" => "لا توجد عقارات متاحة."]);
    exit; // إنهاء السكربت إذا لم تكن هناك نتائج
}

// تحويل المصفوفة إلى JSON وإرجاعها
header('Content-Type: application/json'); // تعيين نوع المحتوى إلى JSON
echo json_encode($properties); // طباعة النتائج في تنسيق JSON

// إغلاق الاتصال بقاعدة البيانات
$conn->close(); // إغلاق الاتصال بعد الانتهاء
?>
