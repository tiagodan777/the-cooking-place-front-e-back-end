<?php
namespace TiagoDaniel\CMS;

class Member {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT id, CONCAT(forename, ' ', surname) AS nome, joined, bio, picture, seo_name
                FROM membro
                WHERE id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function getFull($id) {
        $sql = "SELECT id, forename, surname, joined, bio, picture, email, telefone, nascimento, genero
                FROM membro
                WHERE id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function getAll() {
        $sql = "SELECT id, CONCAT(forename, ' ', surname) AS nome, joined, bio, picture, role
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
            $sql = "INSERT INTO membro (forename, surname, nascimento, genero, email, telefone, password, seo_name)
                    VALUES (:primeiro_nome, :ultimo_nome, :nascimento, :genero, :email, :telemovel, :password, :seo_name);";
            $this->db->runSQL($sql, $member);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                return false;
            }
            throw $e;
        }
    }

    public function update($member) {
        try {
            unset($member['dia']);
            unset($member['mes']);
            unset($member['ano']);
            unset($member['joined']);
            unset($member['picture']);
            $sql = "UPDATE membro
                    SET forename = :forename, surname = :surname, telefone = :telefone, email = :email, bio = :bio,
                                    nascimento = :nascimento, genero = :genero, seo_name = :seo_name
                    WHERE id = :id;";
            $this->db->runSQL($sql, $member);
            return true;
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return false;
            }
            echo "<pre>";
            var_dump($member);
            echo "</pre>";
            throw $e;
        }
    }

    public function login($user, $password) {
        $arguments['user1'] = $user;
        $arguments['user2'] = $user;
        $sql = "SELECT id, forename, surname, nascimento, genero, email, telefone, password, joined, bio, picture, role, seo_name
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

    public function getIdByEmail($email) {
        $sql = "SELECT id FROM membro
                WHERE email = :email;";
        return $this->db->runSQL($sql, [$email])->fetchColumn();
    }

    public function passwordUpdate($id, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE membro
                SET password = :hash
                WHERE id = :id;";
        $this->db->runSQL($sql, ['id' => $id, 'hash' => $hash,]);
        return true;
    }

    public function pictureCreate($member, $temp, $destination) {
        try {   
            $imagick = new \Imagick($temp);
            $imagick->cropThumbnailImage(100, 100);
            $imagick->writeImage($destination);

            $sql = "UPDATE membro
                    SET picture = :picture
                    WHERE id = :id;";
            $this->db->runSQL($sql, [$member['picture'], $member['id']]);
            return true;
        } catch (\Exception $e) {
            if (file_exists($destination)) {
                unlink($destination);
            }
            throw $e;
        }
    }

    public function pictureDelete($id, $path) {
        $sql = "SELECT picture FROM membro WHERE id = :id";
        $file = $this->db->runSQL($sql, [$id])->fetchColumn();

        $path .= $file;

        if (file_exists($path)) {
            unlink($path);
        } else {
            return false;
        }

        $sql = "UPDATE membro SET picture = 'blank.jpg' WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
        return true;
    }

    public function delete($member) {
        try {
            $this->db->beginTransaction();

            $sql = "DELETE FROM receita 
                    WHERE membro_id = :id;";
            $this->db->runSQL($sql, [$member['id']]);

            $sql = "DELETE FROM membro
                    WHERE id = :id;";
            $this->db->runSQL($sql, [$member['id']]);

            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollBack();

            return false;
        }
    }
}