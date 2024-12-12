<?php
class Controller_accueil extends Controller{
    
    /**
     * Action par défaut affichant la page d'acceuil.
     */
    public function action_default(){
        $m=Model::getModel();
        $data=[];
        $this->render("accueil", $data);
    }
}
?>