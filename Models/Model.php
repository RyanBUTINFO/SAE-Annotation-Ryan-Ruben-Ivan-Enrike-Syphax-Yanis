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

    public function getMessagesFromEmotionInConversation()
    {
        $req = $this->bd->prepare('SELECT m.* FROM Messages m
        INNER JOIN Annotation a ON m.message_id = a.message_id
        WHERE a.emotion = :emotion
        AND m.conversation_id = :conversation_id');

        $req->execute(array(':emotion' => $POST_['search_emotion'],
        ':conversation_id' => $POST_['current_conv']));
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

        return $req->fecthAll();
    }

    public function getMessagesFromContentInConversation(){
        $req = $this->bd->prepare('SELECT * FROM Messages m
        INNER JOIN Conversation c ON c.conversation_id = m.conversation_id
        WHERE c.conversation = :conversation');
        $req->execute(array(':conversation' => $_POST['current_conv']));
        $data = $res->fetchAll();
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
}