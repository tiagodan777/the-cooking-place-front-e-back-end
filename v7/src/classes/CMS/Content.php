<?php
namespace TiagoDaniel\CMS;

class Content {
    private $db;

    public function __construct($db)
    {
        $this->db = $db; 
    }

    public function get() {
        $sql = "SELECT *
                FROM (
                    SELECT 
                        r.id,
                        r.titulo,
                        r.descricao,
                        r.data,
                        r.imagem_file AS file,
                        r.seo_title,
                        r.membro_id,
                        CONCAT(m.forename, ' ', m.surname) AS autor,
                        m.picture,
                        NULL AS receita_acoplada_id,
                        'receita' AS tipo_conteudo,
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = r.id) AS likes,
                        (SELECT COUNT(conteudo_id)
                        FROM opiniao
                        WHERE opiniao.conteudo_id = r.id) AS opinioes
                        FROM receita AS r
                        JOIN membro AS m ON m.id = r.membro_id

                    UNION ALL

                    SELECT 
                        q.id,
                        q.titulo,
                        q.descricao,
                        q.data,
                        q.file AS file,
                        q.seo_title,
                        q.membro_id,
                        CONCAT(m.forename, ' ', m.surname) AS autor,
                        m.picture,
                        q.receita_acoplada_id AS receita_acoplada_id,
                        'quik' AS tipo_conteudo,
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = q.id) AS likes,
                        (SELECT COUNT(conteudo_id)
                        FROM opiniao
                        WHERE opiniao.conteudo_id = q.id) AS opinioes
                    FROM quik AS q
                    JOIN membro AS m ON m.id = q.membro_id) AS data
                ORDER BY data DESC;";
        return $this->db->runSQL($sql)->fetchAll();
    }
}