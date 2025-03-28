<?php
namespace TiagoDaniel\CMS;

class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT p.id, p.imagem_file, p.data, p.descricao, p.membro_id,
                CONCAT(m.forename, ' ', m.surname) AS autor, m.picture,
                (SELECT COUNT(conteudo_id) 
                FROM likes
                WHERE likes.conteudo_id = p.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = p.id) AS opinioes
                FROM publicacao_simples AS p
                JOIN membro AS m ON m.id = p.membro_id
                WHERE p.id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function create($post, $temp, $destination) {
        try {
            $imagick = new \Imagick($temp);
            $imagick->cropThumbnailImage(500, 500);
            $imagick->writeImage($destination);
        $sql = "INSERT INTO publicacao_simples (imagem_file, descricao, membro_id)
                VALUES (:imagem_file, :descricao, :membro_id);";
        $this->db->runSQL($sql, $post);
        return true;
        } catch (\Exception $e) {
            if (file_exists($destination)) {
                unlink($destination);
            }
            throw $e;
        } 
    }

    public function update($post) {
        $sql = "UPDATE publicacao_simples
                SET descricao = :descricao
                WHERE id = :id;";
        $this->db->runSQL($sql, $post);
        return true;
    }
}