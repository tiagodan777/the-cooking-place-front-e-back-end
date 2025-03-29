<?php
namespace TiagoDaniel\CMS;

class Like {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function get($like) {
        $sql = "SELECT COUNT(conteudo_id)
                FROM likes
                WHERE conteudo_id = :conteudo_id
                AND membro_id = :membro_id;";
        return $this->db->runSQL($sql, $like)->fetchColumn();
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