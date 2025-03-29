<?php
namespace TiagoDaniel\CMS;

class Content {
    private $db;

    public function __construct($db)
    {
        $this->db = $db; 
    }

    public function get($member = null) {
        $arguments['member'] = $member;
        $arguments['member1'] = $member;
        $arguments['member2'] = $member;
        $arguments['member3'] = $member;
        $arguments['member4'] = $member;
        $arguments['member5'] = $member;
        $arguments['member6'] = $member;
        $arguments['member7'] = $member;
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
                        NULL AS poster,
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = r.id) AS likes,
                        (SELECT COUNT(conteudo_id)
                        FROM opiniao
                        WHERE opiniao.conteudo_id = r.id) AS opinioes
                        FROM receita AS r
                        JOIN membro AS m ON m.id = r.membro_id
                        WHERE (r.membro_id = :member OR :member1 IS NULL)

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
                        q.poster AS poster,
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = q.id) AS likes,
                        (SELECT COUNT(conteudo_id)
                        FROM opiniao
                        WHERE opiniao.conteudo_id = q.id) AS opinioes
                    FROM quik AS q
                    JOIN membro AS m ON m.id = q.membro_id
                    WHERE (q.membro_id = :member2 OR :member3 IS NULL)


                    UNION ALL

                    SELECT
                    p.id, 
                    NULL as titulo,
                    p.descricao,
                    p.data,
                    p.imagem_file AS file,
                    NULL as seo_title,
                    p.membro_id,
                    CONCAT(m.forename, ' ', m.surname) AS autor,
                    m.picture,
                    NULL AS receita_acoplada_id,
                    'publicação' AS tipo_conteudo,
                    NULL as poster,
                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = p.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = p.id) AS opinioes
                    FROM publicacao_simples AS p
                    JOIN membro AS m ON m.id = p.membro_id
                    WHERE (p.membro_id = :member4 OR :member5 IS NULL)

                    UNION ALL

                    SELECT
                    v.id,
                    v.titulo,
                    v.descricao,
                    v.data,
                    v.video_file AS file,
                    v.seo_title,
                    v.membro_id,
                    CONCAT(m.forename, ' ', m.surname) AS autor,
                    m.picture,
                    NULL AS receita_acoplada_id,
                    'video longo' AS tipo_conteudo,
                    v.poster AS poster,
                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = v.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = v.id) AS opinioes
                    FROM video_longo AS v
                    JOIN membro AS m ON m.id = v.membro_id
                    WHERE (v.membro_id = :member6 OR :member7 IS NULL)) AS data
                ORDER BY data DESC;";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }
}