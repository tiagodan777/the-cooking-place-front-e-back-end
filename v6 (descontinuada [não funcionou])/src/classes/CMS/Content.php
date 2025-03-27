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

        $sql = "SELECT c.conteudo_id, c.tipo,
                CASE
                    WHEN c.tipo = 'receita' THEN r.id, r.titulo, r.descricao, r.data, r.imagem_file, r.membro_id, r.seo_title,
                                                CONCAT(m.forename, ' ', m.surname) AS autor,
                                                m.picture, m.seo_name AS seo_member,
                                                (SELECT COUNT(conteudo_id)
                                                FROM likes
                                                WHERE likes.conteudo_id = r.id) AS likes,
                                                (SELECT COUNT(conteudo_id)
                                                FROM opiniao
                                                WHERE opiniao.conteudo_id = r.id) AS opinioes
                    WHEN c.tipo = 'quik THEN q.id, q.titulo, q.descricao, q.file, q.receita_acoplada_id, q.membro_id,
                                            m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture
                END AS data
                FROM conteudo AS c
                JOIN receita AS r ON r.id = c.id
                JOIN membro AS m ON m.id = r.membro_id
                JOIN membro AS m ON m.id = q.membro_id
                ORDER BY id DESC;";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }
}