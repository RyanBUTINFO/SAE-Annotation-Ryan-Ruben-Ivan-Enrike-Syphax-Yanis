<?php

require_once 'Controller.php'; // Assurez-vous que le chemin est correct

class Controller_accueil extends Controller {
    public function action_default() {
        $m = Model::getModel();
        $conversationId = $_GET['conversation_id'] ?? 1;
        $searchContent = $_GET['search_content'] ?? '';
        $data = ["messages" => $m->getMessagesFromContentInConversation($conversationId, $searchContent)];
        $this->render("accueil", $data);
    }

    public function action_send() {
        if (isset($_POST['content']) && isset($_POST['sent_at']) && isset($_POST['id_sender'])
            && isset($_POST['id_recipient']) && isset($_POST['annotation_sender'])
            && isset($_POST['annotation_recipient'])) {

            $content = $_POST['content'];
            $sentAt = $_POST['sent_at'];
            $senderId = $_POST['id_sender'];
            $receiverId = $_POST['id_recipient'];
            $annotationSender = $_POST['annotation_sender'];
            $annotationRecipient = $_POST['annotation_recipient'];

            $m = Model::getModel();
            $m->addMessageWithEmotion($content, $sentAt, $senderId, $receiverId, $annotationSender, $annotationRecipient);
        }
        $this->render("accueil", []);
    }
}
?>