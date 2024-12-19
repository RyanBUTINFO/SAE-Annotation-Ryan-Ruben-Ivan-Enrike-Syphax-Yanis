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
                <button>Paramètres du compte</button>
            </div>
            <div>
                <button>Conditions d'utilisation</button>
            </div>
        </div>
        <div class="content">
            <h1>Paramètres du compte</h1>
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
    </main>
</body>
</html>
