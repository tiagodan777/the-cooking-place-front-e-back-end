<?php
namespace TiagoDaniel\CMS;

use Exception;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use TiagoDaniel\CMS\Like;

class WebSocket implements MessageComponentInterface {
    protected $clients;
    private $pdo;
    private $globalSession;
    private $connSessions = [];

    public function __construct($session, $pdo) {
        $this->clients = new \SplObjectStorage;
        $this->pdo = $pdo;
        $this->globalSession = $session;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! - ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        $action = $data['type'];
        unset($data['type']);

        switch ($action) {
            case 'auth':
                $tokenValue = $data['token'] ?? '';
                if ($tokenValue) {
                    $session = $this->createSessionFromToken($tokenValue);
                    $this->connSessions[$from->resourceId] = $session;
                    echo "Authenticated connection {$from->resourceId} as user ID {$session->id}\n";
                }
                break;
            case 'like':
                $session = $this->connSessions[$from->resourceId] ?? $this->globalSession;
                (new Like($this->pdo, $session)->handle($data));

                $this->broadcastNotifications($data, $session);
                break;
            case 'save':
                $session = $this->connSessions[$from->resourceId] ?? $this->globalSession;
                (new Saved($this->pdo, $session)->handle($data));
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Conncection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        echo "An error ocurred: {$e->getMessage()}\n";
        $conn->close();
    }

    private function broadcastNotifications($data, $session) {
        foreach ($this->clients as $client) {
            $likes = new Like($this->pdo, $session)->count($data);
            $client->send(json_encode($likes));
        }
    }

    /*private function sendNotifications(ConnectionInterface $conn) {
        $statement = $this->pdo->query("SELECT * FROM ")
    }*/

    private function createSessionFromToken($tokenValue) {
        $tokenClass = new Token($this->pdo);
        $memberId = $tokenClass->getMemberId($tokenValue, 'login');

        if (!$memberId) {
            // Token inválido
            return clone $this->globalSession;
        }

        // Agora buscar os dados do membro:
        $sql = "SELECT id, forename, picture, role, seo_name
                FROM membro
                WHERE id = :member_id;";
        $arguments = ['member_id' => $memberId];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($arguments);
        $memberData = $stmt->fetch();

        // Monta uma nova "Session" com estes dados
        $session = clone $this->globalSession;
        $session->id = $memberData['id'];
        $session->forename = $memberData['forename'];
        $session->picture = $memberData['picture'];
        $session->role = $memberData['role'];
        $session->seo_name = $memberData['seo_name'];
        $session->token = $tokenValue;

        return $session;
    }
}

