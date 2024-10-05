document.addEventListener("DOMContentLoaded", function() {
    const chatBox = document.getElementById('chat-box');
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const messagesContainer = document.getElementById('messages');
    const sendButton = document.getElementById('send-button');

    // Disable send button if input is empty
    messageInput.addEventListener('input', function() {
        sendButton.disabled = messageInput.value.trim() === '';
    });

    messageForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const messageText = messageInput.value;
        
        if (messageText.trim() !== '') {
            const newMessage = document.createElement('div');
            newMessage.className = 'message user-message';
            newMessage.innerText = messageText;
            messagesContainer.appendChild(newMessage);

            // Add fade-in effect for the new message
            newMessage.style.opacity = 0;
            setTimeout(() => {
                newMessage.style.opacity = 1;
            }, 50);
            
            // Simulate a response from the admin
            setTimeout(() => {
                const adminMessage = document.createElement('div');
                adminMessage.className = 'message admin-message';
                adminMessage.innerText = 'شكراً لتواصلك معنا. سنعود إليك قريبًا.';
                messagesContainer.appendChild(adminMessage);

                // Add fade-in effect for the admin message
                adminMessage.style.opacity = 0;
                setTimeout(() => {
                    adminMessage.style.opacity = 1;
                }, 50);
            }, 1000);
            
            messageInput.value = '';
            sendButton.disabled = true; // Disable the button again
        }
    });
});
