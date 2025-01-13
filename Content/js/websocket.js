// Connexion WebSocket au serveur PHP Anciennne version 
//var socket = new WebSocket('ws://127.0.0.1:8080'); // Adresse de votre serveur WebSocket

//socket.onopen = function() {
    //console.log('Connexion WebSocket établie');
//};

//socket.onmessage = function(event) {
    //var message = document.createElement("p");
    //message.textContent='Message reçu: ' + event.data;
    //console.log(message);
    //document.body.appendChild(message);
//};

//socket.onerror = function(error) {
    //console.error('Erreur WebSocket: ' + error);
//};

//socket.onclose = function() {
    //console.log('Connexion fermée');
//};

//function sendMessage() {
    //var message = document.getElementById('messageInput').value;
    //socket.send(message); // Envoi du message au serveur WebSocket
// }

// Nouvelle Version 
// Connexion WebSocket au serveur PHP

function connectToWebsocket(){
    var socket = new WebSocket('ws://127.0.0.1:8080'); // Adresse de votre serveur WebSocket
}

socket.onopen = function() {
    console.log('Connexion WebSocket établie');
};

socket.onmessage = function(event) {
    // Créer un élément pour afficher le message reçu
    var message = document.createElement("p");
    message.textContent = 'Message reçu: ' + event.data;

    console.log('Message reçu:', event.data); // Log pour vérification

    // Ajouter le message au conteneur dédié
    var messagesContainer = document.getElementById("messagesContainer");
    if (messagesContainer) {
        messagesContainer.appendChild(message);
    } else {
        // Si le conteneur n'existe pas, ajouter au body (fallback)
        document.body.appendChild(message);
    }
};

socket.onerror = function(error) {
    console.error('Erreur WebSocket: ' + error);
};

socket.onclose = function() {
    console.log('Connexion fermée');
};

function sendMessage() {
    var message = document.getElementById('messageInput').value;
    if (message) {
        socket.send(message); // Envoi du message au serveur WebSocket
        console.log('Message envoyé:', message); // Log pour vérification
    } else {
        console.warn('Aucun message à envoyer');
    }
}



