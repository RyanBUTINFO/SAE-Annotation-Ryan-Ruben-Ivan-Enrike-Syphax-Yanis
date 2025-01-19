<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définit le type de document comme HTML5 -->
    <meta charset="UTF-8"> <!-- Encodage des caractères pour prendre en charge les langues comme le français -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page responsive sur tous les appareils -->
    <title>Annotiverse - Paramètres</title> <!-- Titre affiché dans l'onglet du navigateur -->

    <!-- Ajout d'une icône dans l'onglet -->
    <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">
    
    <!-- Inclusion de la feuille de style pour personnaliser l'apparence -->
    <link rel="stylesheet" href="Content/css/parametre.css">
</head>
<body>
    <header>
        <!-- Logo du site -->
        <img src="Content/img/logo.jpg" alt="Logo Annotiverse"> 
        
        <!-- Titre du site avec un lien pour revenir à l'accueil -->
        <a href="?controller=accueil&action=accueil">
            <h1 class="title">Annotiverse</h1>
        </a>
        
        <!-- Bouton pour se déconnecter -->
        <button class="logout-button">Se déconnecter</button>
    </header>

    <main>
        <!-- Barre latérale pour naviguer entre les sections -->
        <div class="sidebar">
            <div>
                <!-- Bouton pour afficher les paramètres du compte -->
                <button id="bouton_param">Paramètres du compte</button>
            </div>
            <div>
                <!-- Bouton pour afficher les conditions d'utilisation -->
                <button id="bouton_cond">Conditions d'utilisation</button>
            </div>
        </div>

        <!-- Section des paramètres du compte -->
        <div id="param" class="parametres_compte">
            <h1>Paramètres du compte</h1>
            
            <!-- Formulaire pour changer l'image de profil -->
            <form id="change-avatar" method="POST" action="?controller=accueil&action=connecte" enctype="multipart/form-data">
                <div>
                    <img src="Content/img/logo.jpg"></img> <!-- Image actuelle -->
                    <input type="file" placeholder="Importer votre image" id="image" name="image" required></input> <!-- Champ pour importer une nouvelle image -->
                    <button>Changer l'image</button>
                </div>
            </form>

            <!-- Formulaire pour changer l'adresse email -->
            <form id="change-mail" method="POST" action="?controller=accueil&action=connecte">
                <div>
                    <input type="email" placeholder="Votre nouveau mail" id="email" name="email" required></input>
                    <button>Changer l'adresse mail</button>
                </div>
            </form>

            <!-- Formulaire pour changer le mot de passe -->
            <form id="change-password" method="POST" action="?controller=accueil&action=connecte">
                <div>
                    <input type="password" placeholder="Votre nouveau mot de passe" id="password" name="password" required></input>
                    <input type="password" placeholder="Réécrivez votre nouveau mot de passe" id="confirm-password" name="confirm-password" required></input>
                    <button>Confirmer le mot de passe</button>
                </div>
            </form>

            <!-- Formulaire pour changer le nom d'utilisateur -->
            <form id="change-username" method="POST" action="?controller=accueil&action=connecte">
                <div>
                    <input type="text" placeholder="Votre nouveau nom d'utilisateur" id="username" name="username" required>
                    <button>Confirmer le nom d'utilisateur</button>
                </div>
            </form>

            <!-- Formulaire pour supprimer le compte -->
            <form id="delete-account" method="POST" action="?controller=accueil">
                <div>
                    <br><button class="delete">Supprimer votre compte</button>
                </div>
            </form>
        </div>

        <!-- Section des conditions d'utilisation (initialement cachée) -->
        <div id="cond" class="condition_utilisation" hidden>
            <h1>Conditions d'utilisation du site de messagerie</h1>
            
            <!-- Texte explicatif sur les conditions d'utilisation -->
            <br><p>Avant d'utiliser nos services, nous vous demandons de lire attentivement les présentes conditions d'utilisation. En accédant à notre site web et 
            en utilisant nos services, vous acceptez les termes et conditions qui y sont énoncés, y compris la collecte et l'utilisation de vos messages et 
            annotations pour des fins d'études et d'analyses statistiques. Si vous n'êtes pas d'accord avec ces conditions, nous vous prions de ne pas utiliser 
            notre service.</p>
            <!-- Différentes sections détaillant les conditions -->
            <br><br><h2>1. Collecte des messages et annotations</h2>
            <br><p>...</p>
            <br><br><h2>2. Utilisation des données collectées</h2>
            <br><p>...</p>
            <br><br><h2>3. Consentement éclairé</h2>
            <br><p>...</p>
            <br><br><h2>4. Confidentialité et sécurité des données</h2>
            <br><p>...</p>
            <br><br><h2>5. Contact</h2>
            <br><p>Pour toute question, contactez-nous à l’adresse suivante : assistance2annotiverse@gmail.com.</p>
        </div>
    </main>

    <!-- Inclusion du script JavaScript pour gérer l'affichage des sections -->
    <script src="Content/js/parametres.js"></script>
</body>
</html>