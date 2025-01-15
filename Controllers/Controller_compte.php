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
        $m=Model::getModel();
        
        if(isset($_POST['mail']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm-password'])
        && $_POST['password']==$_POST['confirm-password'] && $_POST['terms']=="on" && !$m->checkMailExists($_POST['mail'])
        && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>_])[A-Za-z\d!@#$%^&*(),.?":{}|<>_]{8,}$/', $_POST['password'])){
            $m->createAccount();
            $data=["success"=>"Votre compte a bien été créé.", "username"=>$_POST['username']];
        } else {
            $data=["error"=>"Erreur lors de la création du compte."]; 
        }
        $this->render("success", $data);
    }

    /**
     * Action affichant la page de connexion réussie.
     */
    public function action_succes_connexion(){
        if(isset($_POST['mail']) && isset($_POST['password']) && $_POST['terms']=="on"){
            $m=Model::getModel();
            $m->connectToAccount();
            $data=["success"=>"Connexion réussie.", "username"=>$m->getUsername()];
        } else {
            $data=["error"=>"Erreur lors de la connexion du compte."]; 
        }
        $this->render("success", $data);
    }
}
?>