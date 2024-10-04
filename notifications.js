document.addEventListener("DOMContentLoaded", function() {
    const notificationBox = document.getElementById('notification-box');

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerText = message;
        notificationBox.appendChild(notification);

        // إضافة تأثير للظهور
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateY(0)';
        }, 0);

        // إزالة الإشعار بعد 5 ثوانٍ
        setTimeout(() => {
            // إضافة تأثير للتلاشي قبل الإزالة
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                notification.remove();
            }, 300); // انتظار تأثير التلاشي قبل الإزالة
        }, 5000);
    }

    // مثال على كيفية إضافة إشعار
    showNotification("تمت إضافة عقارك بنجاح!");
});
