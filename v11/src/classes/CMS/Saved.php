<?php
namespace TiagoDaniel\CMS;

class Saved {
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
                FROM guardado
                WHERE conteudo_id = :conteudo_id
                AND membro_id = :membro_id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['conteudo_id' => $data['contentId'], 'membro_id' => $this->session->id]);
        return $statement->fetchColumn();
    }

    public function create($data) {
        $sql = "INSERT INTO guardado (conteudo_id, membro_id, file, tipo_conteudo)
                VALUES (:conteudo_id, :membro_id, :file, :tipo_conteudo);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['conteudo_id' => $data['contentId'], 'membro_id' => $this->session->id, 'file' => $data['file'], 'tipo_conteudo' => $data['tipo_conteudo']]);
        return $statement->fetchColumn();
    }

    public function delete($data) {
        $sql = "DELETE FROM guardado
                WHERE conteudo_id = :conteudo_id
                AND  membro_id = :membro_id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['conteudo_id' => $data['contentId'], 'membro_id' => $this->session->id]);
    }

    public function count() {
        $sql = "SELECT COUNT(membro_id)
                FROM guardado
                WHERE membro_id = :membro_id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['membro_id' => $this->session->id]);
        $saved = $statement->fetchColumn();
        return ['type' => 'saved', 'likes' => $saved];
    }

    public function getFull() {
        $sql = "SELECT conteudo_id, file, tipo_conteudo
                FROM guardado
                WHERE membro_id = :membro;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['membro_id' => $this->session->id]);
        return $statement->fetch();
    }

    public function handle($data) {
        $this->data = $data;
        unset($this->data['type']);

        $saved = $this->get($data);
        if ($saved) {
            $this->delete($data);
        } else {
            $this->create($data);
        }
    }
}