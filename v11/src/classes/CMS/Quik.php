<?php
namespace TiagoDaniel\CMS;

use Google\Service\Compute\FutureReservation;

class Quik {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id, $session = null) {
        $arguments['session'] = $session;

        $sql = "SELECT q.id, q.titulo, q.descricao, q.data, q.receita_acoplada_id, q.youtube_id, q.keywords, q.membro_id, q.seo_title,
                CONCAT(m.forename, ' ', m.surname) AS autor, m.picture,
                (SELECT COUNT(conteudo_id) 
                FROM likes
                WHERE likes.conteudo_id = q.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = q.id) AS opinioes,
                (SELECT COUNT(*)
                FROM guardado
                WHERE guardado.conteudo_id = q.id AND guardado.membro_id = :session) AS guardado
                FROM quik AS q
                JOIN membro AS m ON m.id = q.membro_id
                WHERE q.id = :id;";
        return $this->db->runSQL($sql, ['id' => $id, 'session' => $arguments['session']])->fetch();
    }

    public function getAll($session = null) {
        $arguments['session1'] = $session;
        $arguments['session2'] = $session;

        $sql = "SELECT q.id, q.titulo, q.descricao, q.data, q.receita_acoplada_id, q.youtube_id, q.keywords, q.membro_id, q.seo_title, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture,
                (SELECT COUNT(conteudo_id)
                FROM likes
                WHERE likes.conteudo_id = q.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM likes
                WHERE likes.conteudo_id = q.id AND likes.membro_id = :session1) AS i_like,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = q.id) AS opinioes,
                (SELECT COUNT(*)
                FROM guardado
                WHERE guardado.conteudo_id = q.id AND guardado.membro_id = :session2) AS guardado
                FROM quik AS q
                JOIN membro AS m ON m.id = q.membro_id;";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }

    public function create($titulo, $descricao, $receita_acoplada_id, $keywords, $seo_title, $youtube_id, $membro_id) {
        $sql = "INSERT INTO quik (titulo, descricao, receita_acoplada_id, keywords, seo_title, youtube_id, membro_id)
                VALUES (:titulo, :descricao, :receita_acoplada_id, :keywords, :seo_title, :youtube_id, :membro_id);";
        $this->db->runSQL($sql, [$titulo, $descricao, $receita_acoplada_id, $keywords, $seo_title, $youtube_id, $membro_id]);
    }

    public function update($titulo, $descricao, $receita_acoplada_id, $keywords, $seo_title, $id) {
        $sql = "UPDATE quik
                SET titulo = :titulo, descricao = :descricao, receita_acoplada_id = :receita_acoplada_id, keywords = :keywords, seo_title = :seo_title
                WHERE id = :id;";
        $this->db->runSQL($sql, [$titulo, $descricao, $receita_acoplada_id, $keywords, $seo_title, $id]);
    }

    public function count() {
        $sql = "SELECT COUNT(*) FROM quik;";

        return $this->db->runSQL($sql)->fetchColumn();
    }

    public function delete($id) {
        $sql = "DELETE FROM quik
                WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
    }
}