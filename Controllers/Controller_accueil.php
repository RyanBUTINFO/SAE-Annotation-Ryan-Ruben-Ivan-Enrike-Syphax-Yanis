<?php
class Controller_accueil extends Controller{
    
    public function action_default(){
        $m=Model::getModel();
        $data=["messages" => $m->getMessagesFromContentInConversation()];
        $this->render("accueil", $data);
    }

    public function action_send(){
        if (isset($_POST['sent_at']) and isset($_POST['id_sender'])
        and isset($_POST['id_recipient']) and isset($_POST['annotation_sender'])
        and isset($_POST['annotation_recipient'])){
            $m=Model::getModel();
            $m->addMessageWithEmotion();
        }
        $data=[];
        $this->render("accueil", $data);
    }
}
?>