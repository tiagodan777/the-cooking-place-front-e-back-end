<?php
namespace TiagoDaniel\CMS;

class LongVideo {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT v.id, v.titulo, v.descricao, v.data, v.video_file, v.poster, v.membro_id, 
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

    public function create() {
        
    }
}