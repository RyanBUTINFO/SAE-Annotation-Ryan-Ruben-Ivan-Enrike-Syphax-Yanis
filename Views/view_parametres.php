<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annotiverse - Paramètres</title>
    <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">
    <link rel="stylesheet" href="Content/css/parametre.css">
</head>
<body>
    <header>
        <img src="Content/img/logo.jpg" alt="Logo Annotiverse"> 
        <h1>Annotiverse</h1>
        <button class="logout-button">Se déconnecter</button>
    </header>
    <main>
        <div class="sidebar">
            <div>
                <button id="bouton_param">Paramètres du compte</button>
            </div>
            <div>
                <button id="bouton_cond">Conditions d'utilisation</button>
            </div>
        </div>
        <div id="param" class="parametres_compte">
            <h1>Paramètres du compte</h1>
            <form id="change-avatar" method="POST" action="?controller=accueil&action=connecte">
                <div>
                    <img src="Content/img/logo.jpg"></img>
                    <input type="file" placeholder="Importer votre image" id="image" name="image" required></input>
                    <button>Changer l'image</button>
                </div>
            </form>
            <form id="change-mail" method="POST" action="?controller=accueil&action=connecte">
                <div>
                    <input type="email" placeholder="Votre nouveau mail" id="email" name="email" required></input>
                    <button>Changer l'adresse mail</button>
                </div>
            </form>
            <form id="change-password" method="POST" action="?controller=accueil&action=connecte">
                <div>
                    <input type="password" placeholder="Votre nouveau mot de passe" id="password" name="password" required></input>
                    <input type="password" placeholder="Réécrivez votre nouveau mot de passe" id="confirm-password" name="confirm-password" required></input>
                    <button>Confirmer le mot de passe</button>
                </div>
            </form>
            <form id="change-username" method="POST" action="?controller=accueil&action=connecte">
                <div>
                    <input type="text" placeholder="Votre nouveau nom d'utilisateur" id="username" name="username" required>
                    <button>Confirmer le nom d'utilisateur</button>
                </div>
            </form>
            <form id="delete-account" method="POST" action="?controller=accueil">
                <div>
                    <br><button class="delete">Supprimer votre compte</button>
                </div>
            </form>
        </div>
        <div id="cond" class="condition_utilisation" hidden>
            <h1>Conditions d'utilisation du site de messagerie</h1>
            <br><p>Avant d'utiliser nos services, nous vous demandons de lire attentivement les présentes conditions d'utilisation. En accédant à notre site web et 
            en utilisant nos services, vous acceptez les termes et conditions qui y sont énoncés, y compris la collecte et l'utilisation de vos messages et 
            annotations pour des fins d'études et d'analyses statistiques. Si vous n'êtes pas d'accord avec ces conditions, nous vous prions de ne pas utiliser 
            notre service.</p>
            <br><br><h2>1. Collecte des messages et annotations</h2>
            <br><p>Afin d'améliorer notre service et de réaliser des analyses statistiques, nous collectons vos messages et annotations échangés sur notre 
            plateforme. Cette collecte est effectuée de manière transparente, et vous êtes informé(e) que nous pouvons récupérer, stocker et analyser le 
            contenu de vos échanges. Les types de données collectées peuvent inclure :
            <br>Messages textuels : tout le contenu échangé dans les conversations.
            <br>Annotations : toutes les réactions, donc les emoji.</p>
            <br><br><h2>2. Utilisation des données collectées</h2>
            <br><p>Les données collectées ne sont utilisées qu'à des fins strictement définies d'études et d'analyses statistiques. Ces analyses visent notamment à 
            analyser les différentes interprétations possibles d'un message, entre l'expéditeur et le destinataire.
            <br>Les informations collectées seront utilisées de manière agrégée et anonymisée dans le cadre de ces analyses. En aucun cas, vos données 
            personnelles ne seront divulguées ou utilisées à des fins commerciales non liées aux objectifs précités.</p>
            <br><br><h2>3. Consentement éclairé</h2>
            <br><p>Avant toute collecte de vos messages et annotations, nous vous demandons explicitement votre consentement. Ce consentement est révoqué 
            automatiquement à chaque déconnexion et vous sera demandé à chaque connexion à votre compte.
            <br>Le consentement que vous accordez est basé sur une compréhension claire et complète de l’utilisation de vos données. Vous avez la possibilité 
            de consulter à tout moment vos informations dans la section dédiée à la gestion de la confidentialité.</p>
            <br><br><h2>4. Confidentialité et sécurité des données</h2>
            <br><p>Nous nous engageons à prendre toutes les mesures techniques et organisationnelles nécessaires pour garantir la sécurité et la confidentialité 
            des données collectées. Les informations que vous partagez sont stockées de manière sécurisée et protégées contre toute divulgation non autorisée.
            <br>Nous mettons également en place des procédures de vérification pour nous assurer que vos données sont utilisées uniquement dans les limites 
            spécifiées dans cette politique. En aucun cas, vos informations personnelles identifiables ne seront partagées avec des tiers, sauf si cela est 
            requis par la loi ou pour des raisons techniques liées à la fourniture de notre service.</p>
            <br><br><h2>5. Contact</h2>
            <br><p>Pour toute question relative à vos données personnelles, à la collecte des messages et annotations ou à l’exercice de vos droits, vous pouvez 
            nous contacter en envoyant un email à l’adresse suivante : assistance2annotiverse@gmail.com.
            <br>En utilisant notre service, vous confirmez avoir pris connaissance de ces conditions et consentez à la collecte et à l’utilisation de vos 
            messages et annotations à des fins d’études et d'analyses statistiques. Merci de votre confiance.</p>
        </div>
    </main>
    <script src="Content/js/parametres.js"></script>
</body>
</html>
