<?php require 'vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage; // Stocke les connexions
    }

    public function onOpen(ConnectionInterface $conn) {
        // Stocke la connexion nouvellement ouverte
        $this->clients->attach($conn);
        echo "Nouvelle connexion ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message reçu : $msg\n";

        // Décoder le message JSON
        $data = json_decode($msg, true);

        // Vérifier l'action
        if ($data['action'] === 'sendMessage') {
            $senderId = $data['senderId'];
            $recipientId = $data['recipientId'];
            $content = $data['content'];

            // Logique pour transmettre le message uniquement aux destinataires
            foreach ($this->clients as $client) {
                if (isset($client->userId) && $client->userId == $recipientId) {
                    $client->send(json_encode([
                        'action' => 'newMessage',
                        'senderId' => $senderId,
                        'content' => $content,
                        'timestamp' => date('Y-m-d H:i:s')
                    ]));
                }
            }
        } elseif ($data['action'] === 'register') {
            // Enregistre l'utilisateur connecté
            $from->userId = $data['userId'];
            echo "Utilisateur {$data['userId']} enregistré\n";
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connexion fermée ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Erreur : {$e->getMessage()}\n";
        $conn->close();
    }
}

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

echo "Serveur WebSocket démarré sur ws://127.0.0.1:8080\n";
$server->run();