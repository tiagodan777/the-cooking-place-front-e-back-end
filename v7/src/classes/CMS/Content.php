<?php
namespace TiagoDaniel\CMS;

class Content {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($category = null, $member = null) {
        $arguments['categoria'] = $category;
        $arguments['categoria1'] = $category;
        $arguments['membro'] = $member;
        $arguments['membro1'] = $member;
        $sql = "SELECT
                c.tipo,
                r.id, r.titulo, r.descricao, r.data, r.imagem_file, r.membro_id, r.seo_title,
                CONCAT(m.forename, ' ', m.surname) AS autor,
                m.picture, m.seo_name AS seo_member,

                q.titulo, q.descricao, q.file, q.receita_acoplada_id, q.membro_id,
                m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture,

                (SELECT COUNT(conteudo_id)
                FROM likes
                WHERE likes.conteudo_id = r.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = r.id) AS opinioes

                FROM conteudo AS c
                JOIN receita AS r ON r.id = c.conteudo_id
                JOIN membro AS m ON r.membro_id = m.id
                JOIN quik AS q ON q.id = c.conteudo_id
                
                WHERE (r.categoria_id = :categoria OR :categoria1 IS null)
                AND (r.membro_id = :membro OR :membro1 IS null);";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }
}