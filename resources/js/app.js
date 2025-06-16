import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    window.Echo.channel('chat')
        .listen('.message.sent', (e) => {
            const bubbleChat = document.getElementById('bubble-chat');
            if (bubbleChat) {
                bubbleChat.textContent = e.message;
            }
        });
});
