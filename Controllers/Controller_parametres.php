<?php

class Controller_parametres extends Controller{

    /**
     * Action par défaut affichant la page des paramètres.
     */
    public function action_default(){
        $m=Model::getModel();
        $data=[];
        $this->render("parametres", $data);

    }

    /**
     * Action affichant la page des conditions d'utilisation.
     */
    public function action_conditions(){
        $m=Model::getModel();
        $data=[];
        $this->render("conditions", $data);
    }
}