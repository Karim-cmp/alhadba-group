document.addEventListener("DOMContentLoaded", function() {
    const chatBox = document.getElementById('chat-box');
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const messagesContainer = document.getElementById('messages');

    messageForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        const messageText = messageInput.value; 

        if (messageText.trim() !== '') { 
            const newMessage = document.createElement('div'); 
            newMessage.className = 'message user-message'; 
            newMessage.innerText = messageText; 
            messagesContainer.appendChild(newMessage); 
            animateMessage(newMessage);
            scrollToBottom(); // تمرير تلقائي

            setTimeout(() => {
                const adminMessage = document.createElement('div'); 
                adminMessage.className = 'message admin-message'; 
                adminMessage.innerText = 'شكراً لتواصلك معنا. سنعود إليك قريبًا.'; 
                messagesContainer.appendChild(adminMessage); 
                animateMessage(adminMessage);
                scrollToBottom(); // تمرير تلقائي
            }, 1000); 

            messageInput.value = ''; 
        }
    });
    
    // دالة لتحريك الرسالة عند إضافتها
    function animateMessage(messageElement) {
        messageElement.classList.add('fade-in'); // إضافة الرسوم المتحركة
        setTimeout(() => {
            messageElement.classList.remove('fade-in');
        }, 500); // مدة الرسوم المتحركة
    }

    // دالة للتمرير إلى أسفل
    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight; // تمرير إلى أسفل
    }
});
