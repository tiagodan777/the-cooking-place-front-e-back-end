<?php
namespace TiagoDaniel\CMS;

class Opinion {
    private $db;

    public function __construct($db)
    {   
        $this->db = $db;
    }

    public function getAll($id) {
        $sql = "SELECT o.id, o.opiniao, o.posted, o.membro_id, 
                CONCAT(m.forename, ' ', m.surname) AS autor, m.picture
                FROM opiniao AS o
                JOIN membro AS m ON o.membro_id = m.id;";
        return $this->db->runSQL($sql, [$id])->fetchAll();
    }

    public function create($opiniao) {
        $sql = "INSERT INTO opiniao (opiniao, receita_id, membro_id)
                VALUES (:opiniao, :receita_id, :membro_id);";
        $this->db->runSQL($sql, $opiniao);
        return true;
    }
}