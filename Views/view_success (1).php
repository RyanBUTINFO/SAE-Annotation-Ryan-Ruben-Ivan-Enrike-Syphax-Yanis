<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Réussie</title>
  <link rel="shortcut icon" href="Content/img/logo_onglet.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Content/css/connexion_reussi.css">
</head>
<body>
  <?php if (isset($success)): ?>
  <div class="success-container">
    <h1>Connexion réussie</h1>
    <div class="profile-picture">
      <img src="avatar.jpg" alt="Photo de profil">
    </div>
    <p class="welcome-text">
      <strong><?=$success?></strong><br>
      <span><?=$username?></span>
    </p>
    <form>
      <button formaction="?controller=accueil" class="continue-button">Continuer</button>
    </form>
  </div>
  <?php else: ?>
    <div class="success-container">
    <h1>Connexion échouée</h1>
    <p class="welcome-text">
      <strong><?=$error?></strong>
    </p>
    <form>
      <button formaction="?controller=accueil" class="continue-button">Continuer</button>
    </form>
  </div>
  <?php endif; ?>
</body>
</html>