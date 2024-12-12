<?php
class Controller_compte extends Controller{
    
    /**
     * Action par défaut affichant la page de connexion.
     */
    public function action_default(){
        $m=Model::getModel();
        $data=[];
        $this->render("connexion", $data);
    }

    /**
     * Action affichant la page de création de compte.
     */
    public function action_creation(){
        $m=Model::getModel();
        $data=[];
        $this->render("creation", $data);
    }

    /**
     * Action affichant la page de connexion réussie.
     */
    public function action_succes(){
        $m=Model::getModel();
        $data=[];
        $this->render("succes", $data);
    }
}
?>