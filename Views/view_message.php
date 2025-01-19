<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link rel="stylesheet" href="Content/message.css">
    <script src="Content/websocket.js"></script>
</head>
<body>
    <header>
        <h1>Conversation</h1>
        <a href="index.php?action=logout">Déconnexion</a>
    </header>

    <main>
        <section id="messages">
            <?php foreach ($messages as $message): ?>
                <div class="message <?= $message['sender_id'] == $_SESSION['user_id'] ? 'sent' : 'received' ?>" 
                     data-id="<?= $message['message_id'] ?>">
                    <p><?= htmlspecialchars($message['content']) ?></p>
                    <span class="annotation"><?= htmlspecialchars($message['annotation'] ?? '') ?></span>
                </div>
            <?php endforeach; ?>
        </section>

        <section id="send-message">
            <form id="send-message-form">
                <textarea id="content" placeholder="Votre message"></textarea>
                <select id="annotation">
                    <option value="joie">Joie</option>
                    <option value="colère">Colère</option>
                    <option value="tristesse">Tristesse</option>
                    <option value="surprise">Surprise</option>
                    <option value="dégoût">Dégoût</option>
                    <option value="peur">Peur</option>
                </select>
                <button type="button" onclick="sendMessage()">Envoyer</button>
            </form>
        </section>
    </main>
</body>
</html>