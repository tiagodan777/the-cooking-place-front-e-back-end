<?php
namespace TiagoDaniel\CMS;

use Exception;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ComponentInterface;

class Notification implements MessageComponentInterface {
    /*private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }



    public function getAll($id) {
        $sql = "SELECT n.mensagem, n.emissor_id,
                CONCAT(m.forename, ' ', m.surname) AS emissor,
                m.picture
                FROM notificacao AS n
                JOIN membro AS m ON n.emissor_id = m.id
                WHERE n.recetor_id = :id;";
        return $this->db->runSQL($sql, [$id])->fetchAll();
    }*/

    protected $clients;
    private $pdo;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->pdo = new \PDO("mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;host=localhost;dbname=the-cooking-place", "root", "root");
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->sendNotification($conn);
        echo "New connection: ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);

        /*echo "<pre>";
        var_dump($data);
        echo "</pre>";*/

        if ($data['type'] = "envio_receita") {
            $arguments = [];

            $arguments['type'] = $data['type'];
            $arguments['autor_id'] = $data['autor_id'];
            $arguments['status'] = 0;

            $sql = "INSERT INTO notificacao (tipo, emissor_id, status)
                    VALUES (:type, :autor_id, :status);";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($arguments);
            
            $this->broadcastNotifications();
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conection ({$conn->resourceId}) has disconected\n";
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        echo "An error has ocorred. ({$e->getMessage()})\n";
        $conn->close();
    }

    private function sendNotification($conn) {
        $sql = "SELECT * FROM notificacao ORDER BY id DESC;";

        $notifications = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        $response = [
            'type' => 'notification',
            'notifications' => $notifications,
        ];

        $conn->send(json_encode($response));
    }

    private function broadcastNotifications() {
        foreach ($this->clients as $client) {
            $this->sendNotification($client);
        }
    }
}