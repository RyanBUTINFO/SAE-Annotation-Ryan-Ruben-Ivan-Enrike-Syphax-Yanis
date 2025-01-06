<?php
require 'vendor/autoload.php'; // Chargez les dépendances de composer

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;

// Classe pour gérer les connexions WebSocket
class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage; // Stocke les connexions
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn); // Ajoute la connexion au stockage
        echo "Nouvelle connexion ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message reçu: {$msg}\n";

        // Transmettre le message à tous les clients connectés
        foreach ($this->clients as $client) {
            if ($client !== $from) { // N'envoie pas le message à l'émetteur
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn); // Supprime la connexion du stockage
        echo "Connexion fermée ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Erreur: {$e->getMessage()}\n";
        $conn->close();
    }
}



// Démarre le serveur WebSocket
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080 // Le port d'écoute du serveur WebSocket
);

echo "Serveur WebSocket démarré sur ws://127.0.0.1:8080\n";
$server->run();
