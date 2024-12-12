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
        include __DIR__ . "/../credentials.php";
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

    public function getMessagesFromEmotion($emotion)
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
        $req->bindValue(':emotion', $emotion);
        $req->execute();
        return $req->fetchAll();
    }

}