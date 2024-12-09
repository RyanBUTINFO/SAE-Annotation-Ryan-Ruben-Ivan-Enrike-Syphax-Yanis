<?php
class Controller_compte extends Controller{
    
    /**
     * Action par défaut affichant la page d'acceuil.
     */
    public function action_default(){
        $m=Model::getModel();
        $data=[];
        $this->render("connexion", $data);
    }

    public function action_creation(){
        $m=Model::getModel();
        $data=[];
        $this->render("creation", $data);
    }

    public function action_succes(){
        $m=Model::getModel();
        $data=[];
        $this->render("succes", $data);
    }
}
?>