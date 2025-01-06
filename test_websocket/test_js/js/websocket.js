// Connexion WebSocket au serveur PHP
var socket = new WebSocket('ws://127.0.0.1:8080'); // Adresse de votre serveur WebSocket

socket.onopen = function() {
    console.log('Connexion WebSocket établie');
};

socket.onmessage = function(event) {
    console.log('Message reçu: ' + event.data);
    var message = document.createElement("p");
    message.textContent='Message reçu: ' + event.data;
    console.log(message);
    document.body.appendChild(message);
};

socket.onerror = function(error) {
    console.error('Erreur WebSocket: ' + error);
};

socket.onclose = function() {
    console.log('Connexion fermée');
};

function sendMessage() {
    var message = document.getElementById('messageInput').value;
    socket.send(message); // Envoi du message au serveur WebSocket
}




