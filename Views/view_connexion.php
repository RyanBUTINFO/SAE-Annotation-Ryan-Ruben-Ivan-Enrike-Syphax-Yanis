<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">
  <link rel="stylesheet" href="Content/css/connexion.css">
</head>
<body>
  <div class="account-container">
    <h1>Connexion</h1>
    <form id="account-form" action="?controller=compte&action=succes">
      <input type="email" placeholder="Votre adresse mail" id="email" name="mail" required>
      <input type="password" placeholder="Votre mot de passe" id="password" name="password" required>
      <div class="checkbox-container">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">J'accepte les conditions d'utilisation</label>
      </div>
      <button type="submit" id="login-button">Se connecter</button>
      <p class="create-account">
        Vous n'avez pas de compte ? <a href="?controller=compte&action=creation">Créez-en un !</a>
      </p>
    </form>
  </div>
</body>
</html>
