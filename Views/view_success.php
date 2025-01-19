<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Spécifie le type de document comme HTML5 -->
  <meta charset="UTF-8"> <!-- Encodage des caractères pour supporter les langues comme le français -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page responsive sur tous les appareils -->
  <title>Connexion Réussie</title> <!-- Titre affiché dans l'onglet du navigateur -->

  <!-- Ajout d'une icône dans l'onglet -->
  <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">

  <!-- Inclusion de la police Roboto via Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Inclusion d'une feuille de style personnalisée -->
  <link rel="stylesheet" href="Content/css/connexion_reussi.css">
</head>
<body>
  <!-- Condition PHP : si la connexion est réussie -->
  <?php if (isset($success)): ?>
  <div class="success-container">
    <!-- Message de succès -->
    <h1>Connexion réussie</h1>

    <!-- Section pour afficher la photo de profil -->
    <div class="profile-picture">
      <img src="avatar.jpg" alt="Photo de profil"> <!-- Remplacer par l'avatar de l'utilisateur -->
    </div>

    <!-- Message de bienvenue -->
    <p class="welcome-text">
      <strong><?=$success?></strong><br> <!-- Message de succès (par ex. "Bienvenue !") -->
      <span><?=$username?></span> <!-- Affiche le nom d'utilisateur -->
    </p>

    <!-- Formulaire pour rediriger vers l'accueil -->
    <form>
      <button formaction="?controller=accueil" class="continue-button">Continuer</button>
    </form>
  </div>

  <!-- Condition PHP : si la connexion a échoué -->
  <?php else: ?>
    <div class="success-container">
    <h1>Connexion échouée</h1> <!-- Message d'erreur -->
    <p class="welcome-text">
      <strong><?=$error?></strong> <!-- Affiche le message d'erreur (par ex. "Identifiants incorrects.") -->
    </p>
    <form>
      <button formaction="?controller=accueil" class="continue-button">Continuer</button> <!-- Bouton pour revenir à l'accueil -->
    </form>
  </div>
  <?php endif; ?>
</body>
</html>