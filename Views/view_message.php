<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définit le document comme HTML5 -->
    <meta charset="UTF-8"> <!-- Encodage des caractères pour supporter les accents français -->
    <title>Messages</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->
    
    <!-- Inclusion de la feuille de style CSS pour la mise en page des messages -->
    <link rel="stylesheet" href="Content/message.css">
    
    <!-- Inclusion du script JavaScript pour gérer les WebSockets et l'envoi de messages -->
    <script src="Content/websocket.js"></script>
</head>
<body>
    <header>
        <!-- Titre principal de la page -->
        <h1>Conversation</h1>
        
        <!-- Lien pour se déconnecter -->
        <a href="index.php?action=logout">Déconnexion</a>
    </header>

    <main>
        <!-- Section pour afficher les messages -->
        <section id="messages">
            <!-- Boucle PHP pour afficher les messages existants -->
            <?php foreach ($messages as $message): ?>
                <div class="message <?= $message['sender_id'] == $_SESSION['user_id'] ? 'sent' : 'received' ?>" 
                     data-id="<?= $message['message_id'] ?>">
                    <!-- Contenu du message (échappé pour éviter les attaques XSS) -->
                    <p><?= htmlspecialchars($message['content']) ?></p>
                    
                    <!-- Annotation associée au message (émotion ou sentiment) -->
                    <span class="annotation"><?= htmlspecialchars($message['annotation'] ?? '') ?></span>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Section pour envoyer un nouveau message -->
        <section id="send-message">
            <!-- Formulaire pour l'envoi de message -->
            <form id="send-message-form">
                <!-- Zone de texte pour saisir le contenu du message -->
                <textarea id="content" placeholder="Votre message"></textarea>
                
                <!-- Liste déroulante pour sélectionner une annotation -->
                <select id="annotation">
                    <option value="joie">Joie</option>
                    <option value="colère">Colère</option>
                    <option value="tristesse">Tristesse</option>
                    <option value="surprise">Surprise</option>
                    <option value="dégoût">Dégoût</option>
                    <option value="peur">Peur</option>
                </select>
                
                <!-- Bouton pour envoyer le message -->
                <button type="button" onclick="sendMessage()">Envoyer</button>
            </form>
        </section>
    </main>
</body>
</html>