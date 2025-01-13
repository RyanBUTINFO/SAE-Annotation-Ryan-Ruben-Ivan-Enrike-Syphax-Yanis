// Connexion au serveur WebSocket
var socket = new WebSocket('ws://127.0.0.1:8080');

socket.onopen = function () {
    console.log('Connexion WebSocket établie');

    // Enregistre l'utilisateur après connexion
    const userId = document.body.dataset.userId; // Suppose que l'ID utilisateur est dans un attribut `data-user-id`
    socket.send(JSON.stringify({ action: 'register', userId: userId }));
};

socket.onmessage = function (event) {
    const data = JSON.parse(event.data);

    if (data.action === 'newMessage') {
        // Affiche le message dans l'interface
        const messageContainer = document.getElementById('messagesContainer');
        const message = document.createElement('p');
        message.textContent = `${data.senderId}: ${data.content}`;
        messageContainer.appendChild(message);
    }
};

socket.onerror = function (error) {
    console.error('Erreur WebSocket :', error);
};

socket.onclose = function () {
    console.log('Connexion WebSocket fermée');
};

// Fonction pour envoyer un message
// fonction senMessage() appelé dans index.html 
function sendMessage() {
    const content = document.getElementById('messageInput').value;
    const recipientId = document.getElementById('recipientId').value; // ID du destinataire
    const senderId = document.body.dataset.userId;

    socket.send(JSON.stringify({
        action: 'sendMessage',
        senderId: senderId,
        recipientId: recipientId,
        content: content
    }));

    // Ajoute le message à la discussion
    const messageContainer = document.getElementById('messagesContainer');
    const message = document.createElement('p');
    message.textContent = `Vous: ${content}`;
    messageContainer.appendChild(message);
}
