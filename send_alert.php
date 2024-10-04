<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // إعدادات SMTP (يمكنك تعديلها وفقًا لمزود الخدمة الخاص بك)
    $mail->isSMTP(); // استخدام SMTP
    $mail->Host = 'smtp.example.com'; // خادم SMTP
    $mail->SMTPAuth = true; // تفعيل المصادقة
    $mail->Username = 'your_email@example.com'; // بريدك الإلكتروني
    $mail->Password = 'your_password'; // كلمة المرور
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // تشفير TLS
    $mail->Port = 587; // رقم المنفذ

    // إعداد البريد
    $mail->setFrom('your_email@example.com', 'اسمك');
    $recipientEmail = 'recipient@example.com'; // أضف عناوين البريد الإلكتروني للمستخدمين المهتمين

    // تحقق من صحة البريد الإلكتروني
    if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('عنوان البريد الإلكتروني غير صالح.');
    }

    $mail->addAddress($recipientEmail); 

    // إعداد الموضوع ومحتوى البريد
    $mail->Subject = 'تنبيه جديد عن عقار';
    $mail->isHTML(true); // تفعيل HTML
    $mail->Body    = '
        <html>
        <head>
            <title>تنبيه جديد عن عقار</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { padding: 20px; border: 1px solid #ccc; }
                h1 { color: #333; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>تنبيه جديد عن عقار</h1>
                <p>لقد تم إدراج عقار جديد يتناسب مع معايير بحثك.</p>
                <p>للمزيد من المعلومات، يمكنك زيارة موقعنا.</p>
            </div>
        </body>
        </html>
    ';

    $mail->send();
    echo 'تم إرسال التنبيه.';
} catch (Exception $e) {
    echo "لم يتم إرسال الرسالة. البريد الإلكتروني: {$mail->ErrorInfo}";
}
?>
