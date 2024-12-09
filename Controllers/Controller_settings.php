<?php

public class Controller_settings extends Controller{

    public function action_default(){
        $m=Model::getModel();
        $data=[];
        $this->render("parametre", $data);

    }

    public function get_terms_of_use(){
        $m=Model::getModel();
        $data=[];
        $this->render("conditions", $data);
    }
}