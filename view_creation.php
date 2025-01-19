<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Spécifie que le fichier est un document HTML5 -->
  <meta charset="UTF-8"> <!-- Définit l'encodage des caractères pour supporter le français et autres langues -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure que la page est responsive sur les appareils mobiles -->
  <title>Création de compte</title> <!-- Titre affiché dans l'onglet du navigateur -->

  <!-- Ajout d'une icône dans l'onglet du navigateur -->
  <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">

  <!-- Chargement de la police Roboto via Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Inclusion de la feuille de style personnalisée pour le formulaire -->
  <link rel="stylesheet" href="Content/css/connexion.css">
</head>
<body>
  <!-- Conteneur principal pour le formulaire de création de compte -->
  <div class="account-container">
    <h1>Création de compte</h1> <!-- Titre principal de la page -->

    <!-- Formulaire pour la création de compte -->
    <form id="account-form" method="POST" action="?controller=compte&action=succes_creation">
      <!-- Champ pour entrer l'adresse e-mail (obligatoire) -->
      <input type="email" placeholder="Votre adresse mail" id="email" name="mail" required>
      
      <!-- Champ pour entrer le nom d'utilisateur (obligatoire) -->
      <input type="text" placeholder="Votre nom d'utilisateur" id="username" name="username" required>
      
      <!-- Champ pour entrer le mot de passe (obligatoire) -->
      <input type="password" placeholder="Votre mot de passe" id="password" name="password" required>
      
      <!-- Champ pour confirmer le mot de passe (obligatoire) -->
      <input type="password" placeholder="Confirmer le mot de passe" id="confirm-password" name ="confirm-password" required>
      
      <!-- Section pour accepter les conditions d'utilisation -->
      <div class="checkbox-container">
        <input type="checkbox" id="terms" name="terms" required> <!-- Case à cocher obligatoire -->
        <label for="terms">J'accepte les conditions d'utilisation</label> <!-- Texte associé à la case à cocher -->
      </div>
      
      <!-- Bouton pour soumettre le formulaire -->
      <button type="submit" id="signup-button">Créer un compte</button>
      
      <!-- Message et lien pour les utilisateurs ayant déjà un compte -->
      <p class="create-account">
        Vous avez déjà un compte ? <a href="?controller=compte&action=connexion">Connectez-vous !</a>
      </p>
    </form>
  </div>

<?php
// Vérification si les champs "password" et "confirm-password" sont envoyés via POST
if (isset($_POST['password']) && isset($_POST['confirm-password'])) {
  // Création d'une expression régulière pour valider que les deux mots de passe correspondent
  $er = "/^" . $_POST['password'] . "$/";

  // Vérifie que "confirm-password" correspond à l'expression régulière définie
  if (!preg_match($er, $_POST['confirm-password'])) {
    // Cette section est vide, mais pourrait être utilisée pour afficher un message d'erreur
  }
}
?>
</body>
</html>