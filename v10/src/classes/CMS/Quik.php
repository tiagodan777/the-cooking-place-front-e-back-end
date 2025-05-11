<?php
namespace TiagoDaniel\CMS;

use Google\Service\Compute\FutureReservation;

class Quik {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT q.id, q.titulo, q.descricao, q.data, q.receita_acoplada_id, q.youtube_id, q.keywords, q.membro_id, q.seo_title,
                CONCAT(m.forename, ' ', m.surname) AS autor, m.picture,
                (SELECT COUNT(conteudo_id) 
                FROM likes
                WHERE likes.conteudo_id = q.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = q.id) AS opinioes
                FROM quik AS q
                JOIN membro AS m ON m.id = q.membro_id
                WHERE q.id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function getAll() {
        $sql = "SELECT q.id, q.titulo, q.descricao, q.data, q.receita_acoplada_id, q.youtube_id, q.keywords, q.membro_id, q.seo_title, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture,
                (SELECT COUNT(conteudo_id)
                FROM likes
                WHERE likes.conteudo_id = q.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = q.id) AS opinioes
                FROM quik AS q
                JOIN membro AS m ON m.id = q.membro_id;";
        return $this->db->runSQL($sql)->fetchAll();
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

    public function delete($id) {
        $sql = "DELETE FROM quik
                WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
    }
}