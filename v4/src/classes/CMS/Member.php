<?php
namespace TiagoDaniel\CMS;

use ReturnTypeWillChange;

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

    public function create($member) {
        $member['password'] = password_hash($member['password'], PASSWORD_DEFAULT);

        try {
            unset($member['dia']);
            unset($member['mes']);
            unset($member['ano']);
            $sql = "INSERT INTO membro (forename, surname, nascimento, genero, email, telefone, password)
                    VALUES (:primeiro_nome, :ultimo_nome, :nascimento, :genero, :email, :telemovel, :password);";
            $this->db->runSQL($sql, $member);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                return false;
            }
            throw $e;
        }
    }
}