<?php

class Model
{
    private $bd;
    private static $instance = null;

    private function __construct()
    {
        include 'credentials.php';
        $this->bd = new PDO($dsn, $login, $password);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->exec('SET NAMES utf8mb4');
    }

    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addMessageWithEmotion($content, $sentAt, $senderId, $receiverId, $annotationSender = null, $annotationRecipient = null): int
    {
        $req = $this->bd->prepare('INSERT INTO Messages (content, created_at, sender_id, receiver_id, conversation_id) 
                                   VALUES (:content, :sentAt, :senderId, :receiverId)');
        $req->execute([
            ':content' => $content,
            ':sentAt' => $sentAt,
            ':senderId' => $senderId,
            ':receiverId' => $receiverId
        ]);

        $messageId = (int)$this->bd->lastInsertId();

        if ($annotationSender) {
            $this->addAnnotation($messageId, $senderId, $annotationSender);
        }
        if ($annotationRecipient) {
            $this->addAnnotation($messageId, $receiverId, $annotationRecipient);
        }

        return $messageId;
    }

    public function addAnnotation($messageId, $annotatorId, $emotion)
    {
        $req = $this->bd->prepare('INSERT INTO Annotation (message_id, annotator_id, emotion, created_at) 
                                   VALUES (:messageId, :annotatorId, :emotion, CURRENT_TIMESTAMP)');
        $req->execute([
            ':messageId' => $messageId,
            ':annotatorId' => $annotatorId,
            ':emotion' => $emotion
        ]);
    }

    public function getMessagesFromConversation($conversationId)
    {
        $req = $this->bd->prepare('SELECT * FROM Messages WHERE conversation_id = :conversationId ORDER BY created_at ASC');
        $req->execute([':conversationId' => $conversationId]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }


    public function checkMailExists($email)
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM Users WHERE email = :email');
        $req->execute([':email' => $email]);
        return $req->fetchColumn() > 0; // Vérifie si le nombre d'enregistrements est supérieur à 0
    }
    
public function createAccount($username, $password, $email)
{
    $req = $this->bd->prepare('
        INSERT INTO Users (username, password_hash, email, created_at, last_online_at) 
        VALUES (:username, :password, :email, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    ');
    $req->execute([
        ':username' => htmlspecialchars($username),
        ':password' => password_hash($password, PASSWORD_ARGON2ID),
        ':email' => htmlspecialchars($email)
    ]);

    session_start();
    $_SESSION['user_id'] = $this->bd->lastInsertId();
    $_SESSION['username'] = $username;
}


public function connectToAccount($email, $password)
{
    $req = $this->bd->prepare('SELECT * FROM Users WHERE email = :email');
    $req->execute([':email' => $email]);
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $update = $this->bd->prepare('
            UPDATE Users 
            SET last_online_at = CURRENT_TIMESTAMP 
            WHERE user_id = :user_id
        ');
        $update->execute([':user_id' => $user['user_id']]);

        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
    } else {
        throw new Exception('Identifiants de connexion incorrects.');
    }
}


public function getUsername($userId)
{
    $req = $this->bd->prepare('SELECT username FROM Users WHERE user_id = :user_id');
    $req->execute([':user_id' => $userId]);
    return $req->fetchColumn();
}
public function getMessagesFromContentInConversation($conversationId, $searchContent = '')
{
    $req = $this->bd->prepare('
        SELECT * FROM Messages 
        WHERE conversation_id = :conversationId 
        AND content LIKE :searchContent
        ORDER BY created_at ASC
    ');
    $req->execute([
        ':conversationId' => $conversationId,
        ':searchContent' => '%' . $searchContent . '%'
    ]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}


}
 