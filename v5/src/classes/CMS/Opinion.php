<?php
namespace TiagoDaniel\CMS;

class Opinion {
    private $db;

    public function __construct($db)
    {   
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT o.id, o.opiniao, o.posted, o.membro_id, o.receita_id,
                CONCAT(m.forename, ' ', m.surname) AS autor, m.picture, m.seo_name
                FROM opiniao AS o
                JOIN membro AS m ON o.membro_id = m.id
                WHERE o.id = :id;";
        return $this->db->runSQL($sql, [$id] )->fetch();
    }

    public function getAll($id = null) {
        $sql = "SELECT o.id, o.opiniao, o.posted, o.membro_id, o.receita_id,
                CONCAT(m.forename, ' ', m.surname) AS autor, m.picture, m.seo_name
                FROM opiniao AS o
                JOIN membro AS m ON o.membro_id = m.id
                WHERE o.receita_id = :id
                ORDER BY o.id DESC;";
        return $this->db->runSQL($sql, [$id] )->fetchAll();
    }

    public function create($opiniao) {
        $sql = "INSERT INTO opiniao (opiniao, receita_id, membro_id)
                VALUES (:opiniao, :receita_id, :membro_id);";
        $this->db->runSQL($sql, $opiniao);
        return true;
    }

    public function update($opiniao, $opiniao_id) {
        $arguments['opiniao'] = $opiniao;
        $arguments['opiniao_id'] = $opiniao_id;

        $sql = "UPDATE opiniao 
                SET opiniao = :opiniao
                WHERE id = :opiniao_id;";
    $this->db->runSQL($sql, $arguments);
    return true;
    }

    public function delete($id) {
        $sql = "DELETE FROM opiniao
                WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
        return true;
    }
}