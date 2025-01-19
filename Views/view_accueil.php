<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Spécifie que le document est en HTML5 -->
    <meta charset="UTF-8"> <!-- Définit l'encodage pour prendre en charge les caractères français -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page responsive sur les appareils mobiles -->
    <title>Annotiverse - Accueil</title> <!-- Titre affiché dans l'onglet du navigateur -->

    <!-- Icône affichée dans l'onglet -->
    <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">
    
    <!-- Lien vers le fichier CSS pour la personnalisation de l'apparence -->
    <link rel="stylesheet" href="Content/css/accueil.css">
    
    <!-- Lien vers un fichier JavaScript pour les interactions spécifiques -->
    <script src="Content/js/accueil.js"></script>
</head>
<body>
    <!-- En-tête principal -->
    <header>
        <!-- Logo principal du site -->
        <img src="Content/img/logo.jpg" alt="Logo Annotiverse" class="logo">
        
        <!-- Titre du site avec un lien vers la page d'accueil -->
        <a href="?controller=accueil&action=accueil">
            <h1 class="title">Annotiverse</h1>
        </a>
        
        <!-- Options utilisateur -->
        <div class="user-options">
            <!-- Bouton pour la déconnexion -->
            <button class="logout-button">Se déconnecter</button>
            
            <!-- Lien vers les paramètres utilisateur, accompagné de l'avatar -->
            <a href="?controller=parametres&action=parametres">
                <img src="Content/img/logo.jpg" alt="Avatar utilisateur" class="user-avatar">
            </a>
        </div>
    </header>

    <main>
        <!-- Barre latérale pour afficher la liste des contacts -->
        <aside class="sidebar">
            <h2>Contacts</h2> <!-- Titre de la section des contacts -->

            <!-- Liste des contacts -->
            <ul class="contact-list" id="contact">
                <!-- Contact 1 -->
                <li class="contact-item">
                    <img src="mickey.png" alt="Mickey" class="contact-avatar"> <!-- Avatar du contact -->
                    <div class="contact-info">
                        <p class="contact-name">Mickey <span class="status">&#128308;</span></p> <!-- Nom et statut -->
                        <p class="contact-status">Salut mon ami!</p> <!-- Message de statut -->
                    </div>
                </li>
                <!-- Contact 2 -->
                <li class="contact-item">
                    <img src="goku.png" alt="Goku" class="contact-avatar">
                    <div class="contact-info">
                        <p class="contact-name">Goku</p>
                        <p class="contact-status">Supreme</p>
                    </div>
                </li>
                <!-- Contact 3 -->
                <li class="contact-item">
                    <img src="gobou.png" alt="Gobou" class="contact-avatar">
                    <div class="contact-info">
                        <p class="contact-name">Gobou</p>
                        <p class="contact-status">Pika pika!</p>
                    </div>
                </li>
                <!-- Contact 4 -->
                <li class="contact-item">
                    <img src="obelix.png" alt="Obélix" class="contact-avatar">
                    <div class="contact-info">
                        <p class="contact-name">Obélix</p>
                        <p class="contact-status">Je suis pas gros!</p>
                    </div>
                </li>
                <!-- Contact 5 -->
                <li class="contact-item">
                    <img src="djokovic.png" alt="Djokovic" class="contact-avatar">
                    <div class="contact-info">
                        <p class="contact-name">Djokovic</p>
                        <p class="contact-status">Ah, not too bad, not too bad!</p>
                    </div>
                </li>
                <!-- Contact 6 -->
                <li class="contact-item">
                    <img src="hugo.png" alt="HugoDécrypte" class="contact-avatar">
                    <div class="contact-info">
                        <p class="contact-name">HugoDécrypte</p>
                        <p class="contact-status">Voici l'actualité du jour!</p>
                    </div>
                </li>
                <!-- Contact 7 -->
                <li class="contact-item">
                    <img src="roi.png" alt="Roi" class="contact-avatar">
                    <div class="contact-info">
                        <p class="contact-name">Roi</p>
                        <p class="contact-status">HEHEHEHA!</p>
                    </div>
                </li>
            </ul>
        </aside>

        <!-- Section principale pour afficher les conversations -->
        <section class="chat-area">
            <div class="chat-placeholder"></div> <!-- Conteneur pour les discussions (vide pour le moment) -->
        </section>
    </main>

    <!-- Inclusion d'un fichier JavaScript pour gérer WebSocket ou d'autres interactions dynamiques -->
    <script src="Content/js/websocket.js"></script>
</body>
</html>