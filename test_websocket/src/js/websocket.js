// Connexion WebSocket au serveur
var conn = new WebSocket('ws://127.0.0.1:8080'); // Adresse de ton serveur WebSocket

// Gestion des événements de connexion
conn.onopen = function () {
    console.log('Connexion WebSocket établie');
    
    // Enregistre l'utilisateur auprès du serveur
    conn.send(JSON.stringify({
        action: "register",
        userId: "123" // Remplace par l'ID unique de l'utilisateur
    }));
};

// Gestion des messages reçus
conn.onmessage = function (event) {
    console.log("Message reçu :", event.data);

    // Décoder le message JSON
    var data = JSON.parse(event.data);

    // Vérifie si les données reçues contiennent un message
    if (data.from && data.content) {
        displayMessage(data.from, data.content); // Affiche le message reçu
    } else {
        console.warn("Données reçues inattendues :", data);
    }
};

// Gestion des erreurs WebSocket
conn.onerror = function (error) {
    console.error('Erreur WebSocket:', error);
};

// Gestion de la fermeture de la connexion
conn.onclose = function () {
    console.log('Connexion WebSocket fermée');
};

// Fonction pour envoyer un message
function sendMessage() {
    var messageContent = document.getElementById('messageInput').value; // Contenu du message
    var recipientId = document.getElementById('recipientInput').value; // ID du destinataire

    // Vérifie si les champs sont remplis
    if (messageContent && recipientId) {
        // Envoie un message au serveur
        conn.send(JSON.stringify({
            action: "sendMessage",
            senderId: "123", // Remplace par l'ID de l'utilisateur actuel
            recipientId: recipientId,
            content: messageContent
        }));
        console.log("Message envoyé :", messageContent);

        // Réinitialise le champ de saisie du message
        document.getElementById('messageInput').value = "";
    } else {
        alert("Veuillez entrer un message et un destinataire !");
    }
}

// Fonction pour afficher les messages dans l'interface utilisateur
function displayMessage(from, content) {
    var messageContainer = document.getElementById('messageContainer'); // Div pour afficher les messages
    var messageElement = document.createElement('p'); // Crée un élément paragraphe
    messageElement.textContent = `De ${from} : ${content}`; // Ajoute le contenu du message
    messageContainer.appendChild(messageElement); // Ajoute le message au conteneur
}
