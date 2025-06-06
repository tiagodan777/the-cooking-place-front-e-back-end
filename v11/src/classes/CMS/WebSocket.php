<?php
namespace TiagoDaniel\CMS;

use Exception;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocket implements MessageComponentInterface {
    protected $clients;
    private $pdo;


    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->pdo = new \PDO("mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;host=localhost;dbname=the-cooking-place", "root", "root");
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
            case 'like':
                $sql = "SELECT member_id FROM token
                        WHERE token = :cookieUser;";
                $statement = $this->pdo->prepare($sql);
                $statement->execute(['cookieUser' => $data['cookieUser']]);
                $memberId = $statement->fetch();

                $sql = "SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE conteudo_id = :conteudo_id
                        AND membro_id = :membro_id;";
                $statement = $this->pdo->prepare($sql);
                $statement->execute(['conteudo_id' => $data['contentId'], 'membro_id' => $memberId['member_id']]);
                $liked = $statement->fetchColumn();

                if ($liked) {
                    $sql = "DELETE FROM likes
                            WHERE conteudo_id = :conteudo_id
                            AND membro_id = :membro_id;";
                    $statement = $this->pdo->prepare($sql);
                    $statement->execute(['conteudo_id' => $data['contentId'], 'membro_id' => $memberId['member_id']]);
                } else {
                    $sql = "INSERT INTO likes (conteudo_id, membro_id)
                            VALUES (:contentId, :memberId);";
                    $statement = $this->pdo->prepare($sql);
                    $statement->execute(['contentId' => $data['contentId'], 'memberId' => $memberId['member_id']]);
                }

                $this->broadcastNotifications();
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

    private function broadcastNotifications() {
        foreach ($this->clients as $clients) {
            // Já escrevo
        }
    }
}