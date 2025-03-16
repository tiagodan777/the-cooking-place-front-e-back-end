<?php
namespace TiagoDaniel\CMS;

class Quik {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll() {
        $sql = "SELECT q.titulo, q.descricao, q.file, q.receita_acoplada_id, q.membro_id,
                m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture
                FROM quik AS q
                JOIN membro AS m ON q.membro_id = m.id;";
        return $this->db->runSQL($sql)->fetchAll();
    }
}