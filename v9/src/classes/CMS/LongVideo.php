<?php
namespace TiagoDaniel\CMS;

class LongVideo {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT v.id, v.titulo, v.descricao, v.data, v.youtube_id, v.membro_id, v.keywords, seo_title,
                CONCAT(m.forename, ' ', m.surname) AS autor, m.picture,
                (SELECT COUNT(conteudo_id) 
                FROM likes
                WHERE likes.conteudo_id = v.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = v.id) AS opinioes
                FROM video_longo AS v
                JOIN membro AS m ON m.id = v.membro_id
                WHERE v.id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function create($titulo, $descricao, $keywords, $seo_title,  $youtube_id, $membro_id) {
        $sql = "INSERT INTO video_longo (titulo, descricao, keywords, seo_title, youtube_id, membro_id)
                VALUES (:titulo, :descricao, :keywords, :seo_title, :youtube_id, :membro_id);";
        $this->db->runSQL($sql, [$titulo, $descricao, $keywords, $seo_title, $youtube_id, $membro_id]);
    }

    public function update($titulo, $descricao, $keywords, $seo_title, $id) {
        $sql = "UPDATE video_longo
                SET titulo = :titulo, descricao = :descricao, keywords = :keywords, seo_title = :seo_title
                WHERE id = :id;";
        $this->db->runSQL($sql, [$titulo, $descricao, $keywords, $seo_title, $id]);
    }
}