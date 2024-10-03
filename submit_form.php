<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // تحقق من صحة البيانات
    if (!empty($name) && !empty($email) && !empty($message)) {
        // هنا يمكنك إضافة كود لإرسال البريد الإلكتروني أو حفظ البيانات في قاعدة بيانات
        echo "شكراً لتواصلك معنا، سنقوم بالرد عليك قريبًا!";
    } else {
        echo "يرجى ملء جميع الحقول.";
    }
} else {
    echo "حدث خطأ. يرجى المحاولة لاحقًا.";
}
?>
