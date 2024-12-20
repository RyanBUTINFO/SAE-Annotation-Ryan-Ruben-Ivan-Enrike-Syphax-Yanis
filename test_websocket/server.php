<?php
require 'vendor/autoload.php'; // Chargez les dépendances de composer

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;

// Classe pour gérer les connexions WebSocket
class Chat implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "Nouvelle connexion ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Messag reçu: {$msg}\n";
        //echo "from : {$from}\n";
        //foreach ($from->httpRequest->getConnections() as $client) {
            //if ($client !== $from) {
                //$client->send($msg);  // Transmettre le message à tous les autres clients
           
    }

    public function onClose(ConnectionInterface $conn) {
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
