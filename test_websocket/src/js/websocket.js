// Connexion WebSocket au serveur
var conn = new WebSocket('ws://127.0.0.1:8080');

// Enregistrer l'utilisateur
function registerUser() {
    var userId = document.getElementById('userIdInput').value;
    if (userId) {
        conn.send(JSON.stringify({
            action: "register",
            userId: userId
        }));
        console.log("Utilisateur enregistré avec l'ID :", userId);
    } else {
        alert("Veuillez entrer un ID utilisateur !");
    }
}

// Envoyer un message
function sendMessage() {
    var recipientId = document.getElementById('recipientInput').value;
    var content = document.getElementById('messageInput').value;

    if (recipientId && content) {
        conn.send(JSON.stringify({
            action: "sendMessage",
            recipientId: recipientId,
            content: content
        }));
        console.log("Message envoyé à :", recipientId);
    } else {
        alert("Veuillez remplir tous les champs !");
    }
}

// Réception des messages et des actions
conn.onmessage = function (event) {
    var data = JSON.parse(event.data);

    if (data.action === "userList") {
        updateUserList(data.users);
    } else if (data.from && data.content) {
        displayMessage(data.from, data.content);
    }
};

// Met à jour la liste des utilisateurs connectés
function updateUserList(users) {
    var userListContainer = document.getElementById('userList');
    userListContainer.innerHTML = ""; // Réinitialise la liste

    users.forEach(function (userId) {
        var userElement = document.createElement('div');
        userElement.textContent = `Utilisateur : ${userId}`;
        userElement.onclick = function () {
            document.getElementById('recipientInput').value = userId;
        };
        userListContainer.appendChild(userElement);
    });
}

// Affiche un message reçu
function displayMessage(from, content) {
    var messageContainer = document.getElementById('messageContainer');
    var messageElement = document.createElement('p');
    messageElement.textContent = `De ${from} : ${content}`;
    messageContainer.appendChild(messageElement);
}
