<?php
namespace Chat;
// bibliothèque Ratchet pour Websockets
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

// Classe pour gérer les connexions WebSocket
class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage; // Stocke les connexions
        echo "Serveur démarré "
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