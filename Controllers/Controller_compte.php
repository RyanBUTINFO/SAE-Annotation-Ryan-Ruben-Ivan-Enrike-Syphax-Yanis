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
     * Action affichant la page de création réussie.
     */
    public function action_succes_creation(){
        if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm-password'])
        && $_POST['password']==$_POST['confirm-password'] && $_POST['terms']=="on"){
            $m=Model::getModel();
            $m->createAccount();
            $data=["success"=>"Votre compte a bien été créé."];
        } else {
            $data=["error"=>"Erreur lors de la création du compte."]; 
        }
        $this->render("succes", $data);
    }

    /**
     * Action affichant la page de connexion réussie.
     */
    public function action_succes_connexion(){
        if(isset($_POST['email']) && isset($_POST['password']) && $_POST['terms']=="on"){
            $m=Model::getModel();
            $m->connectToAccount();
            $data=["success"=>"Connexion réussie."];
        } else {
            $data=["error"=>"Erreur lors de la connexion du compte."]; 
        }
        $this->render("succes", $data);
    }
}
?>