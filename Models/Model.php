<?php

class Model
{
    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        include "credentials.php";
        $this->bd = new PDO($dsn, $login, $password);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET names 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getMessagesFromEmotionInConversation()
    {
        $req = $this->bd->prepare('SELECT m.* FROM Messages m
        INNER JOIN Annotation a ON m.message_id = a.message_id
        WHERE a.emotion = :emotion
        AND m.conversation_id = :conversation_id');

        $req->execute(array(':emotion' => $_POST['search_emotion'],
        ':conversation_id' => $_POST['current_conv']));
        $data = $req->fetchAll();
        return $data;
    }

    public function addMessageWithEmotion(){

        $req = $this->bd->prepare('INSERT INTO TABLE message_ VALUES (
        :message_content,
        :sent_at,
        :id_sender,
        :id_recipient,
        :annotation_sender,
        :annotation_recipient)');
        
        $req->execute(array(':message_content' => $_POST['message_content'],
        ':sent_at'=> $_POST['sent_at'],
        ':id_sender'=> $_POST['id_sender'],
        ':id_recipient'=> $_POST['id_recipient'],
        ':annotation_sender'=> $_POST['annotation_sender'],
        ':annotation_recipient'=> $_POST['annotation_recipient']));

        return $req->fetchAll();
    }

    public function getMessagesFromContentInConversation(){
        $req = $this->bd->prepare('SELECT * FROM Messages m
        INNER JOIN Conversation c ON c.conversation_id = m.conversation_id
        WHERE c.conversation = :conversation');
        $req->execute(array(':conversation' => $_POST['current_conv']));
        $data = $req->fetchAll();
        $res = [];
        $er = '/^.' . $_POST['search_content'] . '.$/';
        foreach($data as $ligne){
            if (preg_match($er,$ligne['content'])){
                array_push($res, $ligne);
            }
        }
        if (count($res) == 0){
            return "Aucun message correspondant.";
        }
        else{
            return $res;
        }
    }
    public function annotateMessageSent(){
        $req = $this->bd->prepare('UPDATE message_ SET annotation_sender = :annotation WHERE id_message = :id_msg');
        $req->execute(array(':annotation' => htmlspecialchars($_POST['annotation']),
        ':id_msg' => htmlspecialchars($_POST['message_id'])));
    }

    public function createAccount(){
        if(filter_var($_POST['create_email'], FILTER_VALIDATE_EMAIL) && preg_match($_POST['create_password'], '/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/')){
                
            $req = $this->bd->prepare('INSERT INTO TABLE User VALUES (:username, :password, :email, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)');
            $req->execute(array(':username' => htmlspecialchars($_POST['create_username']),
            ':password' => password_hash($_POST['create_password'],PASSWORD_ARGON2ID),
            ":email" => htmlspecialchars($_POST['create_email'])
        ));

            session_start();
            $_SESSION['user_id'] = $this->bd->lastInsertId();
            $_SESSION['username'] = $_POST['create_username'];
        }
    }

    public function connectToAccount() {
        $req = $this->bd->prepare("SELECT * FROM User WHERE email = :email");
        $req->execute(array(':email' => $_POST['connect_email']));
        $user = $req->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($_POST['connect_password'], $user['password_hash'])) {
            
            $update = $this->bd->prepare("UPDATE User SET last_online_at = CURRENT_TIMESTAMP WHERE user_id = :user_id");
            $update->execute(array(':user_id' => $user['user_id']));
            
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
        }
    }
}