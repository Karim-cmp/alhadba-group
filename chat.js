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
            
            // Simulate a response from the admin
            setTimeout(() => {
                const adminMessage = document.createElement('div');
                adminMessage.className = 'message admin-message';
                adminMessage.innerText = 'شكراً لتواصلك معنا. سنعود إليك قريبًا.';
                messagesContainer.appendChild(adminMessage);
            }, 1000);
            
            messageInput.value = '';
        }
    });
});
    