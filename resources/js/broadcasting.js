/*
we use Echo to connect/subscribe to a channel and listen for the event.

anyone who connect/subscribe to a channel can get the data - messages which
get broadcast to that channel

here we want to connect to 'chat' channel

in echo.js we have configured to what channel the application should connect
*/

let channel = window.Echo.channel('chat');

channel.listen('Example', (e) => {    // define which event it should listen to get the broadcast data

    // e  contains the data of the event which receives

    console.log('Received event:', e);
    console.log('Message:', e.message);

    // Update the UI
    const messagesDiv = document.getElementById('messages');
    if (messagesDiv) {

        const messageElement = document.createElement('p');

        messageElement.textContent = `
            Received message: ${e.message} => Email: ${e.user.email}
        `;

        messagesDiv.appendChild(messageElement);
    }
});

// Log subscription status
channel.subscribed(() => {
    console.log('Successfully subscribed to channel: chat');
});

channel.error((error) => {
    console.error('Channel error:', error);
});
