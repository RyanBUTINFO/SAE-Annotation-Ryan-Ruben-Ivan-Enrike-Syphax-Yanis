<?php
require '../vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Nouvelle connexion ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);

        if (!isset($data['action'])) {
            echo "Action non spécifiée\n";
            return;
        }

        switch ($data['action']) {
            case 'register':
                $userId = $data['userId'] ?? uniqid();
                $this->clients[$from] = ["userId" => $userId];
                echo "Utilisateur {$userId} enregistré\n";

                // Diffuser la liste des utilisateurs
                $this->broadcastUserList();
                break;

            case 'sendMessage':
                $this->sendMessageToRecipient($from, $data['recipientId'], $data['content']);
                break;

            default:
                echo "Action inconnue : {$data['action']}\n";
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $userId = $this->clients[$conn]["userId"] ?? "Inconnu";
        $this->clients->detach($conn);
        echo "Utilisateur {$userId} déconnecté ({$conn->resourceId})\n";

        // Diffuser la liste des utilisateurs
        $this->broadcastUserList();
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Erreur : {$e->getMessage()}\n";
        $conn->close();
    }

    private function broadcastUserList() {
        $userList = [];
        foreach ($this->clients as $client) {
            if (isset($this->clients[$client]["userId"])) {
                $userList[] = $this->clients[$client]["userId"];
            }
        }

        foreach ($this->clients as $client) {
            $client->send(json_encode([
                "action" => "userList",
                "users" => $userList
            ]));
        }
    }

    private function sendMessageToRecipient(ConnectionInterface $from, $recipientId, $content) {
        foreach ($this->clients as $client) {
            if ($this->clients[$client]["userId"] === $recipientId) {
                $client->send(json_encode([
                    "from" => $this->clients[$from]["userId"],
                    "content" => $content
                ]));
                echo "Message envoyé de {$this->clients[$from]["userId"]} à {$recipientId} : {$content}\n";
                return;
            }
        }

        echo "Utilisateur {$recipientId} introuvable\n";
    }
}

$server = Ratchet\Server\IoServer::factory(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Chat()
        )
    ),
    8080
);

echo "Serveur WebSocket démarré sur ws://127.0.0.1:8080\n";
$server->run();
