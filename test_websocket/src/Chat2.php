<?php require '../vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage; // Stocke les connexions
    }

    public function onOpen(ConnectionInterface $conn) {
        // Stocke la connexion nouvellement ouverte
        $this->clients->attach($conn,["userId" => null]);
        echo "Nouvelle connexion ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message reçu : $msg\n";

        // Décoder le message JSON
        $data = json_decode($msg, true);

        if (!isset($data['action'])) {
            echo "Erreur : action non spécifiée\n";
            return;
        }

        switch ($data['action']) {
            case 'register':
                if (isset($data['userId'])) {
                    $this->clients[$from]["userId"] = $data['userId'];
                    echo "Utilisateur {$data['userId']} enregistré\n";
                } else {
                    echo "Erreur : userId manquant\n";
                }
                break;

            case 'sendMessage':
                if (isset($data['recipientId'], $data['content'])) {
                    $this->sendMessageToRecipient($from, $data['recipientId'], $data['content']);
                } else {
                    echo "Erreur : recipientId ou content manquant\n";
                }
                break;

            default:
                echo "Action inconnue : {$data['action']}\n";
        }
    }



    private function sendMessageToRecipient(ConnectionInterface $from, $recipientId, $content) {
        $senderId = $this->clients[$from]["userId"] ?? "Inconnu";

        foreach ($this->clients as $client) {
            if ($this->clients[$client]["userId"] === $recipientId) {
                $client->send(json_encode([
                    "from" => $senderId,
                    "content" => $content
                ]));
                echo "Message de {$senderId} \u00e0 {$recipientId} : {$content}\n";
                return;
            }
        }

        echo "Erreur : destinataire {$recipientId} introuvable\n";
    }

        

    public function onClose(ConnectionInterface $conn) {
        $userId = $this->clients[$conn]["userId"] ?? "Inconnu";
        $this->clients->detach($conn);
        echo "Utilisateur {$userId} d\u00e9connect\u00e9 ({$conn->resourceId})\n";
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