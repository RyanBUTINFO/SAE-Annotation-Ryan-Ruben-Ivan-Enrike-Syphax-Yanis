<?php

public class Controller_settings extends Controller{

    public function action_default(){
        $this->view->title='settings';

    }

    public function get_terms_of_use(){
        $this->view->title='terms_of_use';
    }
}