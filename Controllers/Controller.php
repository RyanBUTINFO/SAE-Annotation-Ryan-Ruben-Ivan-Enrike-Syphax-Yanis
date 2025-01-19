<?php

abstract class Controller
{
    /**
     * Constructeur. Lance l'action correspondante
     */
    public function __construct()
    {
        // On détermine s'il existe dans l'URL un paramètre action correspondant à une action du contrôleur
        if (isset($_GET['action']) && method_exists($this, "action_" . $_GET["action"])) {
            // Si c'est le cas, on appelle cette action
            $action = "action_" . $_GET["action"];
            $this->$action();
        } else {
            // Sinon, on appelle l'action par défaut
            $this->action_default();
        }
    }

    /**
     * Action par défaut du contrôleur (à définir dans les classes filles)
     */
    abstract public function action_default();

    /**
     * Affiche la vue
     * @param string $vue Nom de la vue
     * @param array $data Tableau contenant les données à passer à la vue
     */
    protected function render($vue, $data = [])
    {
        // On extrait les données à afficher
        extract($data);

        // On teste si la vue existe
        $file_name = "Views/view_" . $vue . '.php';
        if (file_exists($file_name)) {
            // Si oui, on l'affiche
            include $file_name;
        } else {
            // Sinon, on affiche la page d'erreur
            $this->action_error("La vue '$vue' n'existe pas !");
        }
        // Terminer le script
        exit;
    }

    /**
     * Méthode affichant une page d'erreur
     * @param string $message Message d'erreur à afficher
     */
    protected function action_error($message = '')
    {
        // Vérifie si la vue "message" existe avant de la rendre
        $file_name = "Views/view_message.php";
        if (file_exists($file_name)) {
            $data = [
                'title' => "Erreur",
                'message' => $message ?: "Une erreur est survenue.",
            ];
            $this->render("message", $data);
        } else {
            // Si la vue "message" n'existe pas, afficher un message simple
            echo $message ?: "Une erreur est survenue.";
        }
        exit;
    }
}