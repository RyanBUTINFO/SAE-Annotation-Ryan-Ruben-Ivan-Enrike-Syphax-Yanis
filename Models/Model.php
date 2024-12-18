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
        $this->bd->query("SET nameS 'utf8'");
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

    public function getMessagesFromEmotion()
    {
        $req = $this->bd->prepare('SELECT 
    m.message_content, 
    e.emotion_char AS emotion
FROM 
    message_ m
JOIN 
    annotation a_sender ON m.annotation_sender = a_sender.code_hexa
JOIN 
    emotion e ON a_sender.id_emotion = e.id_emotion
JOIN 
    users u_sender ON m.id_sender = u_sender.id_user
JOIN 
    users u_recipient ON m.id_recipient = u_recipient.id_user
WHERE 
    e.emotion_char = :emotion');
        $req->bindValue(':emotion', $_POST['emotion_cherche']);
        $req->execute();
        if (count($req->fetchAll()) == 0){
            return "Émotion introuvable.";
        }
        else{
            return $req->fetchAll();
        }
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

        return $req->fecthAll();
    }

    public function getMessagesFromContent(){
        $req = $this->bd->prepare('SELECT * FROM message_');
        $req->execute();
        $data = $res->fetchAll();
        $res = [];
        $er = '/^.' . $_POST['content_cherche'] . '.$/';
        foreach($data as $ligne){
            if (preg_match($er,$ligne['message_content'])){
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
}