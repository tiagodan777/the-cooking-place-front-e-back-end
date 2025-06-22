<?php
namespace TiagoDaniel\CMS;

class Follow {
    private $pdo;
    private $data;
    private $session;

    public function __construct($pdo, $session) {
        $this->pdo = $pdo;
        $this->session = $session;
    }

    public function get($membro_id_1, $membro_id_2) {
        $arguments['membro_id_1'] = $membro_id_1;
        $arguments['membro_id_2'] = $membro_id_2;

        $sql = "SELECT membro_id_1, membro_id_2 FROM seguir
                WHERE membro_id_1 = :membro_id_1 AND membro_id_2 = :membro_id_2;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['membro_id_1' => $arguments['membro_id_1'], 'membro_id_2' => $arguments['membro_id_2']]);
        return $statement->fetch();
    }

    public function create($membro_id_1, $membro_id_2) {
        $arguments['membro_id_1'] = $membro_id_1;
        $arguments['membro_id_2'] = $membro_id_2;

        $sql = "INSERT INTO seguir (membro_id_1, membro_id_2)
                VALUES (:membro_id_1, :membro_id_2);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['membro_id_1' => $arguments['membro_id_1'], 'membro_id_2' => $arguments['membro_id_2']]);
        return true;
    }

    public function getFollowers($id) {
        $sql = "SELECT m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture, m.seo_name FROM seguir AS s
                JOIN membro AS m ON m.id = s.membro_id_1
                WHERE s.membro_id_2 = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetchAll();
    }

    public function getFollowing($id) {
        $sql = "SELECT m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture, m.seo_name FROM seguir AS s
                JOIN membro AS m ON m.id = s.membro_id_2
                WHERE s.membro_id_1 = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetchAll();
    }

    public function delete($membro_id_1, $membro_id_2) {
        $arguments['membro_id_1'] = $membro_id_1;
        $arguments['membro_id_2'] = $membro_id_2;

        $sql = "DELETE FROM seguir WHERE membro_id_1 = :membro_id_1 AND membro_id_2 = :membro_id_2;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['membro_id_1' => $arguments['membro_id_1'], 'membro_id_2' => $arguments['membro_id_2']]);
        return true;
    }

    public function countFollowers($id) {
        $sql = "SELECT COUNT(membro_id_2) 
                FROM seguir
                WHERE membro_id_2 = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        $followers = $statement->fetchColumn();
        return ['type' => 'follow', 'followers' => $followers];
    }

    public function handle($data) {
        $this->data = $data;
        unset($this->data['type']);

        $followed = $this->get($this->session->id, $data['profileId']);
        if ($followed) {
            $this->delete($this->session->id, $data['profileId']);
            $status = 'unfollowed';
        } else {
            $this->create($this->session->id, $data['profileId']);
            $status = 'followed';
        }

        return [
            'type' => 'follow',
            'profileId' => $data['profileId'],
            'status' => $status,
            'userId' => $this->session->id
        ];
    }
}