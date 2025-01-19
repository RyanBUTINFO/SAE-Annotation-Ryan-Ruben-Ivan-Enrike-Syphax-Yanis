<?php

// Inclusion du modèle
require_once "Models/Model.php";

// Liste des contrôleurs
$controllers = ["accueil", "parametres", "compte", "message"];

// Nom du contrôleur par défaut
$controller_default = "accueil";

// Vérification si le paramètre "controller" existe dans l'URL et correspond à un contrôleur de la liste
if (isset($_GET['controller']) && in_array($_GET['controller'], $controllers)) {
    $nom_controller = $_GET['controller'];
} else {
    $nom_controller = $controller_default; // Si non spécifié, on utilise le contrôleur par défaut
}

// Détermination du nom de la classe du contrôleur
$nom_classe = 'Controller_' . $nom_controller;

// Détermination du chemin du fichier contenant la définition du contrôleur
$nom_fichier = 'Controllers/' . $nom_classe . '.php';

// Si le fichier du contrôleur existe et est lisible
if (is_readable($nom_fichier)) {
    require_once $nom_fichier;
    
    // Vérification si la classe du contrôleur existe avant de l'instancier
    if (class_exists($nom_classe)) {
        $controller = new $nom_classe();
    } else {
        // Gestion de l'erreur si la classe n'est pas définie
        header("HTTP/1.0 500 Internal Server Error");
        die("Erreur : La classe '$nom_classe' n'existe pas dans le fichier '$nom_fichier'.");
    }
} else {
    // Gestion de l'erreur si le fichier du contrôleur est introuvable
    header("HTTP/1.0 404 Not Found");
    die("Erreur 404 : Le fichier du contrôleur '$nom_fichier' est introuvable.");
}
