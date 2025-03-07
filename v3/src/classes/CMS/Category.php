<?php
namespace TiagoDaniel\CMS;

class Category {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT id, nome, descricao FROM categoria
                WHERE id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function getAll() {
        $sql = "SELECT id, nome, descricao FROM categoria;";
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function count() {
        $sql = "SELECT COUNT(*) FROM categoria";
        return $this->db->runSQL($sql)->fetchColumn();
    }

    public function create($category) {
        try {
            $sql = "INSERT INTO categoria (nome, descricao) VALUES
                    (:nome, :descricao);";
            $this->db->runSQL($sql, $category);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                return false;
            } else {
                throw $e;
            }
        }
    }

    public function update($category) {
        try {
            $sql = "UPDATE categoria 
                    SET nome = :nome, descricao = :descricao
                    WHERE id = :id;";
            $this->db->runSQL($sql, $category);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                return false;
            } else {
                throw $e;
            }
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM categoria WHERE id = :id;";
            $this->db->runSQL($sql, [$id]);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1217) {
                return false;
            } else {
                throw $e;
            }
        }
    }
}