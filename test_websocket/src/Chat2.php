<?php
require 'vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nouvelle connexion ! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);

        switch ($data['action']) {
            case 'sendMessage':
                $message = [
                    'action' => 'newMessage',
                    'content' => $data['content'],
                    'senderId' => $data['senderId'],
                    'receiverId' => $data['receiverId'],
                    'annotation' => $data['annotation'] ?? null,
                ];

                foreach ($this->clients as $client) {
                    $client->send(json_encode($message));
                }
                break;

            case 'addAnnotation':
                $annotation = [
                    'action' => 'newAnnotation',
                    'messageId' => $data['messageId'],
                    'annotatorId' => $data['annotatorId'],
                    'emotion' => $data['emotion'],
                ];

                foreach ($this->clients as $client) {
                    $client->send(json_encode($annotation));
                }
                break;
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connexion fermée ! ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Erreur : {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = \Ratchet\Server\IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new ChatServer()
        )
    ),
    8080
);

echo "Serveur WebSocket démarré sur ws://127.0.0.1:8080\n";
$server->run();
