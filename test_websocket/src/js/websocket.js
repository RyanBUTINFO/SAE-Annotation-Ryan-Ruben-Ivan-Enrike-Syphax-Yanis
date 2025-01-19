const socket = new WebSocket('ws://127.0.0.1:8080');

socket.onopen = () => {
    console.log('Connexion WebSocket établie');
};

socket.onmessage = (event) => {
    const data = JSON.parse(event.data);
    if (data.action === 'newMessage') {
        displayMessage(data);
    }
};

function sendMessage() {
    const content = document.getElementById('content').value;
    const annotation = document.getElementById('annotation').value;

    socket.send(JSON.stringify({
        action: 'sendMessage',
        content,
        senderId: currentUserId,
        receiverId: currentConversationId,
        annotation
    }));
}

function displayMessage(data) {
    const container = document.getElementById('messages');
    const div = document.createElement('div');
    div.className = data.senderId === currentUserId ? 'message sent' : 'message received';
    div.innerHTML = `<p>${data.content}</p><span>${data.annotation}</span>`;
    container.appendChild(div);
}
