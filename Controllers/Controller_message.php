<?php
class MessageController
{
    private $model;

    public function __construct()
    {
        $this->model = Model::getModel();
    }

    public function sendMessage($content, $sentAt, $senderId, $receiverId, $annotationSender = null, $annotationRecipient = null)
    {
        try {
            // Appeler la méthode et récupérer l'ID du message inséré
            $messageId = $this->model->addMessageWithEmotion(
                $content,
                $sentAt,
                $senderId,
                $receiverId,
                $annotationSender,
                $annotationRecipient
            );

            echo "Message envoyé avec succès. ID du message : $messageId";
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi du message : " . $e->getMessage();
        }
    }

    public function annotateMessage($messageId, $annotatorId, $emotion)
    {
        try {
            $this->model->addAnnotation($messageId, $annotatorId, $emotion);
            echo "Annotation ajoutée avec succès.";
        } catch (Exception $e) {
            echo "Erreur lors de l'ajout de l'annotation : " . $e->getMessage();
        }
    }

    public function getMessages($conversationId)
    {
        try {
            $messages = $this->model->getMessagesFromConversation($conversationId);
            return $messages;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des messages : " . $e->getMessage();
            return [];
        }
    }
}
?>