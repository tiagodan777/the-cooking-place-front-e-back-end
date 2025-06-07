<?php
namespace TiagoDaniel\CMS;

class Like {
    private $pdo;
    // private $from;
    private $data;
    private $session;

    public function __construct($pdo, $session) {
        $this->pdo = $pdo;
        // $this->from = $from;
        $this->session = $session;
    }

    public function get($data) {
        $sql = "SELECT COUNT(conteudo_id)
                FROM likes
                WHERE conteudo_id = :conteudo_id
                AND membro_id = :membro_id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['conteudo_id' => $data['contentId'], 'membro_id' => $this->session->id]);
        return $statement->fetchColumn();
    }

    public function create($data) {
        $sql = "INSERT INTO likes (conteudo_id, membro_id)
                VALUES (:contentId, :memberId);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['contentId' => $data['contentId'], 'memberId' => $this->session->id]);
    }

    public function delete($data) {
        $sql = "DELETE FROM likes
                WHERE conteudo_id = :conteudo_id
                AND membro_id = :membro_id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['conteudo_id' => $data['contentId'], 'membro_id' => $this->session->id]);
    }

    public function count($data) {
        $sql = "SELECT COUNT(conteudo_id)
                FROM likes
                WHERE conteudo_id = :conteudo_id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['conteudo_id' => $data['contentId']]);
        $likes = $statement->fetchColumn();
        return ['type' => 'like', 'likes' => $likes, 'contentId' => $data['contentId']];
    }

    public function handle($data) {
        $this->data = $data;
        unset($this->data['type']);

        $liked = $this->get($data);
        if ($liked) {
            $this->delete($data);
        } else {
            $this->create($data);
        }
    }
}