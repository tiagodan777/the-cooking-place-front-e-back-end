<?php
namespace TiagoDaniel\CMS;

use Exception;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ComponentInterface;

class Follow implements MessageComponentInterface {
    private $db;
    protected $clients;
    private $pdo;

    public function __construct($db)
    {
        $this->db = $db;
        $this->clients = new \SplObjectStorage;
        $this->pdo = new \PDO("mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;host=localhost;dbname=the-cooking-place", "root", "root");
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);

        if ($data['type'] == "seguir") {
            $this->create($data['userId'], $data['profileId']);
        } else {
            $this->delete($data['userId'], $data['profileId']);
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

    public function get($membro_id_1, $membro_id_2) {
        $arguments['membro_id_1'] = $membro_id_1;
        $arguments['membro_id_2'] = $membro_id_2;

        $sql = "SELECT membro_id_1, membro_id_2 FROM seguir
                WHERE membro_id_1 = :membro_id_1 AND membro_id_2 = :membro_id_2;";
        return $this->db->runSQL($sql, $arguments)->fetch();
    }

    public function create($membro_id_1, $membro_id_2) {
        $arguments['membro_id_1'] = $membro_id_1;
        $arguments['membro_id_2'] = $membro_id_2;

        $sql = "INSERT INTO seguir (membro_id_1, membro_id_2)
                VALUES (:membro_id_1, :membro_id_2);";
        var_dump($arguments);
        $this->db->runSQL($sql, $arguments);
        return true;
    }

    public function getFollowers($id) {
        $sql = "SELECT m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture, m.seo_name FROM seguir AS s
                JOIN membro AS m ON m.id = s.membro_id_1
                WHERE s.membro_id_2 = :id;";
        return $this->db->runSQL($sql, [$id])->fetchAll();
    }

    public function getFollowing($id) {
        $sql = "SELECT m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture, m.seo_name FROM seguir AS s
                JOIN membro AS m ON m.id = s.membro_id_2
                WHERE s.membro_id_1 = :id;";
        return $this->db->runSQL($sql, [$id])->fetchAll();
    }

    public function delete($membro_id_1, $membro_id_2) {
        $arguments['membro_id_1'] = $membro_id_1;
        $arguments['membro_id_2'] = $membro_id_2;

        $sql = "DELETE FROM seguir WHERE membro_id_1 = :membro_id_1 AND membro_id_2 = :membro_id_2;";
        $this->db->runSQL($sql, $arguments);
        return true;
    }
}