<?php

// bibliothèque Ratchet pour Websockets
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . './vendor/autoload.php';

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
