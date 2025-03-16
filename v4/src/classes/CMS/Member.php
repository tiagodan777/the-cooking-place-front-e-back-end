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

    public function login($user, $password) {
        $arguments['user1'] = $user;
        $arguments['user2'] = $user;
        $sql = "SELECT id, forename, surname, nascimento, genero, email, telefone, password, joined, bio, picture, role
                FROM membro
                WHERE email = :user1
                OR telefone = :user2;";
        $member = $this->db->runSQL($sql, $arguments)->fetch();
        if (!$member) {
            return false;
        }
        $authenticated = password_verify($password, $member['password']);
        return ($authenticated ? $member : false);
    }
}