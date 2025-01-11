<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Création de compte</title>
  <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Content/css/connexion.css">
</head>
<body>
  <div class="account-container">
    <h1>Création de compte</h1>
    <form id="account-form" method="POST" action="?controller=compte&action=succes">
      <input type="email" placeholder="Votre adresse mail" id="email" name="email" required>
      <input type="text" placeholder="Votre nom d'utilisateur" id="username" name="username" required>
      <input type="password" placeholder="Votre mot de passe" id="password" name="password" required>
      <input type="password" placeholder="Confirmer le mot de passe" id="confirm-password" name ="confirm-password" required>
      <div class="checkbox-container">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">J'accepte les conditions d'utilisation</label>
      </div>
      <button type="submit" id="signup-button">Créer un compte</button>
      <p class="create-account">
        Vous avez déjà un compte ? <a href="?controller=compte&action=connexion">Connectez-vous !</a>
      </p>
    </form>
  </div>

<?php
if (isset($_POST['password']) && isset($_POST['confirm-password'])){
  $er = "/^".$_POST['password']."$/";
  if (!preg_match($er, $_POST['confirm-password'])){
    
  }
}
?>

</body>
</html>
