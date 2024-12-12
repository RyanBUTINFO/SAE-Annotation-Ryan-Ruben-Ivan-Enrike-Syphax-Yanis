<?php

class Controller_settings extends Controller{

    public function action_default(){
        $m=Model::getModel();
        $data=[];
        $this->render("parametre", $data);

    }

    public function action_conditions(){
        $m=Model::getModel();
        $data=[];
        $this->render("conditions", $data);
    }
}