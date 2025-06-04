<?php
namespace TiagoDaniel\CMS;

class Saved {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($saved) {
        $sql = "SELECT COUNT(conteudo_id)
                FROM guardado
                WHERE conteudo_id = :conteudo_id
                AND membro_id = :membro_id;";
        return $this->db->runSQL($sql, $saved)->fetchColumn();
    }

    public function create($saved) {
        $sql = "INSERT INTO guardado (conteudo_id, membro_id, file, tipo_conteudo)
                VALUES (:conteudo_id, :membro_id, :file, :tipo_conteudo);";
        $this->db->runSQL($sql, $saved);
    }

    public function delete($saved) {
        $sql = "DELETE FROM guardado
                WHERE conteudo_id = :conteudo_id
                AND  membro_id = :membro_id;";
        $this->db->runsql($sql, $saved);
    }

    public function count($membro) {
        $sql = "SELECT COUNT(membro_id)
                FROM guardado
                WHERE membro_id = :membro_id;";
        return $this->db->runSQL($sql, [$membro])->fetchColumn();
    }

    public function getFull($membro) {
        $sql = "SELECT conteudo_id, file, tipo_conteudo
                FROM guardado
                WHERE membro_id = :membro;";
        return $this->db->runSQL($sql, [$membro])->fetchAll();
    }
}