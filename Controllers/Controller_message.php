<?php
require_once 'Controller.php';

class Controller_message extends Controller
{
    private $m;

    /**
     * Constructeur pour initialiser le modèle.
     */
    public function __construct()
    {
        $this->m = Model::getModel();
    }

    /**
     * Action par défaut.
     * Cette action affiche les messages d'une conversation spécifique.
     */
    public function action_default()
    {
        // Récupérer l'ID de la conversation (par défaut : 1)
        $conversationId = $_GET['conversation_id'] ?? 1;

        try {
            // Obtenir les messages de la conversation
            $data = [
                "messages" => $this->m->getMessagesFromConversation($conversationId)
            ];

            // Rendu de la vue "message" avec les données
            $this->render("message", $data);
        } catch (Exception $e) {
            // Gestion des erreurs
            $this->render("error", ["message" => "Erreur lors du chargement des messages : " . $e->getMessage()]);
        }
    }

    /**
     * Méthode pour envoyer un message.
     */
    public function sendMessage($content, $sentAt, $senderId, $receiverId, $annotationSender = null, $annotationRecipient = null)
    {
        try {
            $this->m->addMessageWithEmotion($content, $sentAt, $senderId, $receiverId, $annotationSender, $annotationRecipient);
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $e->getMessage();
        }
    }

    /**
     * Méthode pour récupérer les messages d'une conversation.
     */
    public function getMessages($conversationId)
    {
        try {
            return $this->m->getMessagesFromConversation($conversationId);
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des messages : " . $e->getMessage();
            return [];
        }
    }

    /**
     * Méthode pour annoter un message avec une émotion.
     */
    public function annotateMessage($messageId, $annotatorId, $emotion)
    {
        try {
            $this->m->addAnnotation($messageId, $annotatorId, $emotion);
        } catch (Exception $e) {
            echo "Erreur lors de l'ajout de l'annotation : " . $e->getMessage();
        }
    }
}
