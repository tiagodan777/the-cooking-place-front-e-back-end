<?php
namespace TiagoDaniel\CMS;

class Like {
    private $pdo;
    private $conn;
    private $data;

    public function __construct($pdo, $conn, $data) {
        $this->pdo = $pdo;
        $this->conn = $conn;
        $this->data = $data;

    }

    public function get($like) {
        $sql = "SELECT COUNT(conteudo_id)
                FROM likes
                WHERE conteudo_id = :conteudo_id
                AND membro_id = :membro_id;";
        return $this->pdo->runSQL($sql, $like)->fetchColumn();
    }

    public function create($like) {
        $sql = "INSERT INTO likes (conteudo_id, membro_id)
                VALUES (:conteudo_id, :membro_id);";
        $this->db->runSQL($sql, $like);
        return true;
    }

    public function delete($like) {
        $sql = "DELETE FROM likes
                WHERE conteudo_id = :conteudo_id
                AND membro_id = :membro_id;";
        $this->db->runSQL($sql, $like);
    }
}