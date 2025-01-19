<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Définit le type de document comme HTML5 -->
  <meta charset="UTF-8"> <!-- Définit l'encodage des caractères pour prendre en charge les caractères spéciaux comme les accents français -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page responsive sur les appareils mobiles -->
  <title>Connexion</title> <!-- Titre affiché dans l'onglet du navigateur -->

  <!-- Ajout d'une icône dans l'onglet du navigateur -->
  <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">

  <!-- Inclusion du fichier CSS pour personnaliser l'apparence -->
  <link rel="stylesheet" href="Content/css/connexion.css">
</head>
<body>
  <!-- Conteneur principal pour la connexion -->
  <div class="account-container">
    <h1>Connexion</h1> <!-- Titre principal de la page -->

    <!-- Formulaire de connexion -->
    <form id="account-form" action="?controller=compte&action=succes_connexion" method="POST">
      <!-- Champ pour entrer l'adresse e-mail -->
      <input type="email" placeholder="Votre adresse mail" id="email" name="mail" required>
      
      <!-- Champ pour entrer le mot de passe -->
      <input type="password" placeholder="Votre mot de passe" id="password" name="password" required>
      
      <!-- Case à cocher pour accepter les conditions d'utilisation -->
      <div class="checkbox-container">
        <input type="checkbox" id="terms" name="terms" required> <!-- Obligatoire grâce à l'attribut "required" -->
        <label for="terms">J'accepte les conditions d'utilisation</label>
      </div>
      
      <!-- Bouton pour soumettre le formulaire -->
      <button type="submit" id="login-button">Se connecter</button>
      
      <!-- Message et lien pour les utilisateurs sans compte -->
      <p class="create-account">
        Vous n'avez pas de compte ? 
        <a href="?controller=compte&action=creation">Créez-en un !</a> <!-- Lien vers la page de création de compte -->
      </p>
    </form>
  </div>
</body>
</html>