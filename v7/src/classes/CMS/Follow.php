<?php
namespace TiagoDaniel\CMS;

class Follow {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
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

    public function delete($membro_id_1, $membro_id_2) {
        $arguments['membro_id_1'] = $membro_id_1;
        $arguments['membro_id_2'] = $membro_id_2;

        $sql = "DELETE FROM seguir WHERE membro_id_1 = :membro_id_1 AND membro_id_2 = :membro_id_2;";
        $this->db->runSQL($sql, $arguments);
        return true;
    }
}