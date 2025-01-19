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
        $this->bd->exec("SET NAMES 'utf8'");
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

    /**
     * Ajoute un message avec émotion (et des annotations si fournies)
     */
    public function addMessageWithEmotion(
        $content,
        $sentAt,
        $senderId,
        $receiverId,
        $annotationSender = null,
        $annotationRecipient = null
    ): int {
        try {
            // Insérer le message dans la table Messages
            $req = $this->bd->prepare('INSERT INTO Messages (content, created_at, sender_id, receiver_id) 
                                       VALUES (:content, :sentAt, :senderId, :receiverId)');
            $req->execute([
                ':content' => $content,
                ':sentAt' => $sentAt,
                ':senderId' => $senderId,
                ':receiverId' => $receiverId
            ]);
    
            // Récupérer l'ID du message inséré
            $messageId = (int)$this->bd->lastInsertId();
    
            // Si des annotations sont fournies, les ajouter
            if ($annotationSender) {
                $this->addAnnotation($messageId, $senderId, $annotationSender);
            }
            if ($annotationRecipient) {
                $this->addAnnotation($messageId, $receiverId, $annotationRecipient);
            }
    
            // Retourner l'ID du message
            return $messageId;
    
        } catch (PDOException $e) {
            // Gérer les erreurs SQL
            throw new Exception("Erreur lors de l'ajout du message : " . $e->getMessage());
        }
    }
    
    /**
     * Ajoute une annotation pour un message donné
     */
    public function addAnnotation($messageId, $annotatorId, $emotion) {
        $req = $this->bd->prepare('INSERT INTO Annotation (message_id, annotator_id, emotion, created_at) 
                                   VALUES (:messageId, :annotatorId, :emotion, CURRENT_TIMESTAMP)');
        $req->execute([
            ':messageId' => $messageId,
            ':annotatorId' => $annotatorId,
            ':emotion' => $emotion
        ]);
    }

    /**
 * Récupère les messages contenant un certain contenu dans une conversation spécifique
 */
    public function getMessagesFromContentInConversation($conversationId, $searchContent = '') {
        $req = $this->bd->prepare('SELECT * FROM Messages WHERE conversation_id = :conversationId AND content LIKE :searchContent ORDER BY created_at ASC');
        $req->execute([
        ':conversationId' => $conversationId,
        ':searchContent' => '%' . $searchContent . '%', // Rechercher une correspondance partielle
    ]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

    /**
     * Récupère les messages d'une conversation donnée
     */
    public function getMessagesFromConversation($conversationId) {
        $req = $this->bd->prepare('SELECT * FROM Messages WHERE conversation_id = :conversationId ORDER BY created_at ASC');
        $req->execute([':conversationId' => $conversationId]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les messages d'une conversation avec une émotion spécifique
     */
    public function getMessagesFromEmotionInConversation($conversationId, $emotion) {
        $req = $this->bd->prepare('SELECT m.* FROM Messages m
                                   INNER JOIN Annotation a ON m.message_id = a.message_id
                                   WHERE a.emotion = :emotion
                                   AND m.conversation_id = :conversation_id');
        $req->execute([
            ':emotion' => $emotion,
            ':conversation_id' => $conversationId
        ]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un compte utilisateur
     */
    public function createAccount($username, $password, $email) {
        $req = $this->bd->prepare('INSERT INTO Users (username, password_hash, email, created_at, last_online_at) 
                                   VALUES (:username, :password, :email, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)');
        $req->execute([
            ':username' => htmlspecialchars($username),
            ':password' => password_hash($password, PASSWORD_ARGON2ID),
            ':email' => htmlspecialchars($email)
        ]);

        session_start();
        $_SESSION['user_id'] = $this->bd->lastInsertId();
        $_SESSION['username'] = $username;
    }

    /**
     * Connecte un utilisateur à son compte
     */
    public function connectToAccount($email, $password) {
        $req = $this->bd->prepare("SELECT * FROM Users WHERE email = :email");
        $req->execute([':email' => $email]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $update = $this->bd->prepare("UPDATE Users SET last_online_at = CURRENT_TIMESTAMP WHERE user_id = :user_id");
            $update->execute([':user_id' => $user['user_id']]);

            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
        } else {
            throw new Exception("Invalid login credentials.");
        }
    }

    /**
     * Vérifie si un email existe dans la base de données
     */
    public function checkMailExists($email) {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM Users WHERE email = :email');
        $req->execute([':email' => $email]);
        return $req->fetchColumn() > 0;
    }

    /**
     * Récupère le nom d'utilisateur d'un utilisateur connecté
     */
    public function getUsername($userId) {
        $req = $this->bd->prepare('SELECT username FROM Users WHERE user_id = :user_id');
        $req->execute([':user_id' => $userId]);
        return $req->fetchColumn();
    }
}
