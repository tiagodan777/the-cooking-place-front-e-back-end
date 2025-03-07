<?php
namespace TiagoDaniel\CMS;

class Member {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT id, CONCAT(forename, ' ', surname) AS nome, joined, bio, picture
                FROM membro
                WHERE id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function getAll() {
        $sql = "SELECT id, CONCAT(forename, ' ', surname) AS nome, joined, bio, picture
                FROM membro;";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function count() {
        $sql = "SELECT COUNT(*) FROM membro;";
        return $this->db->runSQL($sql)->fetchColumn();
    }
}