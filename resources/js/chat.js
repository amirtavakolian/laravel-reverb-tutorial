const messagesContainer = document.getElementById('messages');
const messageForm = document.getElementById('message-form');
const messageInput = document.getElementById('message-input');

//  🔴 2- read here
// for events with namespace you should write namespace like this => .App\\Events\\Chat\\MessageSent


let channel = window.Echo.channel('chatting-time');
channel.listen('.App\\Events\\Chat\\MessageSent', (e) => {
    console.log(e);
    const messageDiv = document.createElement('div');
    messageDiv.className = 'flex items-start space-x-3';
    messageDiv.innerHTML = `
                    <div class="flex-1 bg-gray-100 rounded-lg px-4 py-2">
                        <div class="font-medium text-gray-900">${e.username || 'Anonymous'}</div>
                        <div class="text-gray-700">${e.message}</div>
                        <div class="text-xs text-gray-500">${new Date().toLocaleTimeString()}</div>
                    </div>
                `;
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
});

// Handle form submission
messageForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = messageInput.value.trim();

    if (!message) return;

    try {
        const response = await fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({message})
        });

        if (response.ok) {
            messageInput.value = '';
        }
    } catch (error) {
        console.error('Error sending message:', error);
    }
});
