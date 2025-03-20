<?php
namespace TiagoDaniel\CMS;

class Notification {
    private $db;

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
    }
}