<?php
namespace TiagoDaniel\CMS;

use Google\Service\Safebrowsing\FindThreatMatchesRequest;
use HTML5TreeConstructer;

class Content {
    private $db;

    public function __construct($db)
    {
        $this->db = $db; 
    }

    public function get($member = null, $from = 0, $limit = 10, $session = null) {
        $arguments['member'] = $member;
        $arguments['member1'] = $member;
        $arguments['member2'] = $member;
        $arguments['member3'] = $member;
        $arguments['member4'] = $member;
        $arguments['member5'] = $member;
        $arguments['member6'] = $member;
        $arguments['member7'] = $member;
        $arguments['session1'] = $session;
        $arguments['session2'] = $session;
        $arguments['session3'] = $session;
        $arguments['session4'] = $session;
        $arguments['session5'] = $session;
        $arguments['session6'] = $session;
        $arguments['session7'] = $session;
        $arguments['session8'] = $session;
        $arguments['from'] = $from;
        $arguments['limit'] = $limit;

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
                        /*NULL AS poster,*/
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = r.id) AS likes,
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = r.id AND likes.membro_id = :session5) AS i_like,
                        (SELECT COUNT(conteudo_id)
                        FROM opiniao
                        WHERE opiniao.conteudo_id = r.id) AS opinioes,
                        (SELECT COUNT(*)
                        FROM guardado
                        WHERE guardado.conteudo_id = r.id AND guardado.membro_id = :session1) AS guardado
                        FROM receita AS r
                        JOIN membro AS m ON m.id = r.membro_id
                        WHERE (r.membro_id = :member OR :member1 IS NULL)

                    UNION ALL

                    SELECT 
                        q.id,
                        q.titulo,
                        q.descricao,
                        q.data,
                        q.youtube_id AS file,
                        q.seo_title,
                        q.membro_id,
                        CONCAT(m.forename, ' ', m.surname) AS autor,
                        m.picture,
                        q.receita_acoplada_id AS receita_acoplada_id,
                        'quik' AS tipo_conteudo,
                        /*q.poster AS poster,*/
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = q.id) AS likes,
                        (SELECT COUNT(conteudo_id)
                        FROM likes
                        WHERE likes.conteudo_id = q.id AND likes.membro_id = :session6) AS i_like,
                        (SELECT COUNT(conteudo_id)
                        FROM opiniao
                        WHERE opiniao.conteudo_id = q.id) AS opinioes,
                        (SELECT COUNT(*)
                        FROM guardado
                        WHERE guardado.conteudo_id = q.id AND guardado.membro_id = :session2) AS guardado
                        
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
                    /*NULL as poster,*/
                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = p.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = p.id AND likes.membro_id = :session7) AS i_like,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = p.id) AS opinioes,
                    (SELECT COUNT(*)
                    FROM guardado
                    WHERE guardado.conteudo_id = p.id AND guardado.membro_id = :session3) AS guardado
                    FROM publicacao_simples AS p
                    JOIN membro AS m ON m.id = p.membro_id
                    WHERE (p.membro_id = :member4 OR :member5 IS NULL)

                    UNION ALL

                    SELECT
                    v.id,
                    v.titulo,
                    v.descricao,
                    v.data,
                    v.youtube_id AS file,
                    v.seo_title,
                    v.membro_id,
                    CONCAT(m.forename, ' ', m.surname) AS autor,
                    m.picture,
                    NULL AS receita_acoplada_id,
                    'vídeo longo' AS tipo_conteudo,
                    /*v.poster AS poster,*/
                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = v.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = v.id AND likes.membro_id = :session8) AS i_like,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = v.id) AS opinioes,
                    (SELECT COUNT(*)
                    FROM guardado
                    WHERE guardado.conteudo_id = v.id AND guardado.membro_id = :session4) AS guardado
                    FROM video_longo AS v
                    JOIN membro AS m ON m.id = v.membro_id
                    WHERE (v.membro_id = :member6 OR :member7 IS NULL)) AS data
                ORDER BY data DESC
                LIMIT :limit
                OFFSET :from";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }

    public function getTitle($id) {
        $arguments['id'] = $id;
        $arguments['id1'] = $id;
        $arguments['id2'] = $id;
        $arguments['id3'] = $id;
        $sql = "SELECT *
                FROM (
                    SELECT 
                        titulo
                        FROM receita
                        WHERE id = :id
                    UNION ALL

                    SELECT 
                        titulo
                    FROM quik
                    WHERE id = :id1


                    UNION ALL

                    SELECT
                    descricao
                    FROM publicacao_simples 
                    WHERE id = :id2

                    UNION ALL

                    SELECT
                    titulo
                    FROM video_longo
                    WHERE id = :id3 ) AS data;";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }

    public function searchCount($term) {
        $arguments['term1'] = '%' . $term . '%';
        $arguments['term2'] = '%' . $term . '%';
        $arguments['term3'] = '%' . $term . '%';
        $arguments['term4'] = '%' . $term . '%';
        $arguments['term5'] = '%' . $term . '%';
        $arguments['term6'] = '%' . $term . '%';
        $arguments['term7'] = '%' . $term . '%';
        $arguments['term8'] = '%' . $term . '%';

        $sql = "SELECT COUNT(*) FROM receita AS r

                JOIN categoria AS c ON r.categoria_id = c.id
                JOIN membro AS m ON r.membro_id = m.id

                WHERE r.titulo LIKE :term1
                OR r.descricao LIKE :term2
                OR r.ingredientes LIKE :term3
                OR r.passos_preparacao LIKE :term4
                OR r.keywords LIKE :term5
                OR c.nome LIKE :term6
                OR m.forename LIKE :term7
                OR m.surname LIKE :term8";

        $receitas_count = $this->db->runSQL($sql, $arguments)->fetchColumn();

        unset($arguments);
        $arguments['term1'] = '%' . $term . '%';
        $arguments['term2'] = '%' . $term . '%';
        $arguments['term3'] = '%' . $term . '%';
        $arguments['term4'] = '%' . $term . '%';
        $arguments['term5'] = '%' . $term . '%';
        
        $sql = "SELECT COUNT(*) FROM quik AS q
                JOIN membro AS m ON q.membro_id = m.id

                WHERE q.titulo LIKE :term1
                OR q.descricao LIKE :term2
                OR q.keywords LIKE :term3
                OR m.forename LIKE :term4
                OR m.surname LIKE :term5";
        $quik_count = $this->db->runSQL($sql, $arguments)->fetchColumn();

        unset($arguments);
        $arguments['term1'] = '%' . $term . '%';
        $arguments['term2'] = '%' . $term . '%';
        $arguments['term3'] = '%' . $term . '%';
        $arguments['term4'] = '%' . $term . '%';

        $sql = "SELECT COUNT(*) FROM publicacao_simples AS p

                JOIN membro AS m ON p.membro_id = m.id

                WHERE p.descricao LIKE :term1
                OR p.keywords LIKE :term2
                OR m.forename LIKE :term3
                OR m.surname LIKE :term4";
        $publicacao_simples_count = $this->db->runSQL($sql, $arguments)->fetchColumn();

        unset($arguments);
        $arguments['term1'] = '%' . $term . '%';
        $arguments['term2'] = '%' . $term . '%';
        $arguments['term3'] = '%' . $term . '%';
        $arguments['term4'] = '%' . $term . '%';
        $arguments['term5'] = '%' . $term . '%';
            
        $sql = "SELECT COUNT(*) FROM video_longo AS v
            
                JOIN membro AS m ON v.membro_id = m.id

                WHERE v.titulo LIKE :term1
                OR v.descricao LIKE :term2
                OR v.keywords LIKE :term3
                OR m.forename LIKE :term4
                OR m.surname LIKE :term5;";
        $video_longo_count = $this->db->runsql($sql, $arguments)->fetchColumn();

        $count = $receitas_count + $quik_count + $publicacao_simples_count + $video_longo_count;

        return $count;
    }

    public function search($term, $show = 5, $from = 0) {
        $arguments['term1'] = '%' . $term . '%';
        $arguments['term2'] = '%' . $term . '%';
        $arguments['term3'] = '%' . $term . '%';
        $arguments['term4'] = '%' . $term . '%';
        $arguments['term5'] = '%' . $term . '%';
        $arguments['term6'] = '%' . $term . '%';
        $arguments['term7'] = '%' . $term . '%';
        $arguments['term8'] = '%' . $term . '%';

        $arguments['term9'] = '%' . $term . '%';
        $arguments['term10'] = '%' . $term . '%';
        $arguments['term11'] = '%' . $term . '%';
        $arguments['term12'] = '%' . $term . '%';

        $arguments['term13'] = '%' . $term . '%';
        $arguments['term14'] = '%' . $term . '%';
        $arguments['term15'] = '%' . $term . '%';
        $arguments['term16'] = '%' . $term . '%';
        $arguments['term17'] = '%' . $term . '%';
        $arguments['term18'] = '%' . $term . '%';

        $arguments['term19'] = '%' . $term . '%';
        $arguments['term20'] = '%' . $term . '%';
        $arguments['term21'] = '%' . $term . '%';
        $arguments['term22'] = '%' . $term . '%';

        $arguments['show'] = $show;
        $arguments['from'] = $from;

        $sql = "SELECT *
                FROM (
                    SELECT
                    r.id,
                    r.titulo,
                    r.descricao,
                    r.imagem_file AS file,
                    r.seo_title,
                    r.data,
                    'receita' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = r.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = r.id) AS opinioes,
                    (SELECT COUNT(id) FROM views
                    WHERE views.conteudo_id = r.id) AS views


                    FROM receita AS r

                    JOIN categoria AS c ON r.categoria_id = c.id
                    JOIN membro AS m ON r.membro_id = m.id

                    WHERE r.titulo LIKE :term1
                    OR r.descricao LIKE :term2
                    OR r.ingredientes LIKE :term3
                    OR r.passos_preparacao LIKE :term4
                    OR r.keywords LIKE :term5
                    OR c.nome LIKE :term6
                    OR m.forename LIKE :term7
                    OR m.surname LIKE :term8


                    
                    UNION ALL




                    SELECT 
                    q.id,
                    q.titulo,
                    q.descricao,
                    q.youtube_id AS file,
                    q.seo_title,
                    q.data,
                    'quik' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = q.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = q.id) AS opinioes,
                    (SELECT COUNT(id) FROM views
                    WHERE views.conteudo_id = q.id) AS views

                    FROM quik AS q

                    JOIN membro AS m ON q.membro_id = m.id
                    
                    WHERE q.titulo LIKE :term9
                    OR q.descricao LIKE :term10
                    OR q.keywords LIKE :term11
                    OR m.forename LIKE :term12
                    OR m.surname LIKE :term13



                    UNION ALL



                    SELECT
                    p.id, 
                    NULL as titulo,
                    p.descricao,
                    p.imagem_file AS file,
                    NULL as seo_title,
                    p.data,
                    'publicação' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = p.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = p.id) AS opinioes,
                    (SELECT COUNT(id) FROM views
                    WHERE views.conteudo_id = p.id) AS views

                    FROM publicacao_simples AS p
                    JOIN membro AS m ON m.id = p.membro_id

                    WHERE p.descricao LIKE :term14
                    OR p.keywords LIKE :term15
                    OR m.forename LIKE :term16
                    OR m.surname LIKE :term17



                    UNION ALL



                    SELECT
                    v.id,
                    v.titulo,
                    v.descricao,
                    v.youtube_id AS file,
                    v.seo_title,
                    v.data,
                    'vídeo longo' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = v.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = v.id) AS opinioes,
                    (SELECT COUNT(id) FROM views
                    WHERE views.conteudo_id = v.id) AS views

                    FROM video_longo AS v
                    JOIN membro AS m ON m.id = v.membro_id
                    
                    WHERE v.titulo LIKE :term18
                    OR v.descricao LIKE :term19
                    OR v.keywords LIKE :term20
                    OR m.forename LIKE :term21
                    OR m.surname LIKE :term22) AS data
                ORDER BY data DESC
                LIMIT :show
                OFFSET :from;";
        $conteudos = $this->db->runSQL($sql, $arguments)->fetchAll();

        array_splice($arguments, 15);

        $sql = "SELECT DISTINCT m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture
                FROM membro AS m

                LEFT JOIN receita AS r ON m.id = r.membro_id
                LEFT JOIN publicacao_simples AS p ON m.id = p.membro_id
                LEFT JOIN quik AS q ON m.id = q.membro_id
                LEFT JOIN video_longo AS v ON m.id = v.membro_id

                WHERE
                r.titulo LIKE :term1
                OR r.descricao LIKE :term2
                OR r.ingredientes LIKE :term3
                OR r.passos_preparacao LIKE :term4
                OR r.keywords LIKE :term5
                OR m.forename LIKE :term6 
                OR m.surname LIKE :term7

                OR q.titulo LIKE :term8
                OR q.descricao LIKE :term9
                OR q.keywords LIKE :term10

                OR p.descricao LIKE :term11
                OR p.keywords LIKE :term12

                OR v.titulo LIKE :term13
                OR v.descricao LIKE :term14 
                OR v.keywords LIKE :term15;";
        $membros = $this->db->runSQL($sql, $arguments)->fetchAll();

        return [$conteudos, $membros];
    }

    public function count() {
        $sql = "SELECT *
                FROM (
                    SELECT COUNT(*) FROM receita
                    
                    UNION ALL
                    
                    SELECT COUNT(*) FROM quik
                    
                    UNION ALL
                    
                    SELECT COUNT(*) FROM publicacao_simples
                    
                    UNION ALL
                    
                    SELECT COUNT(*) FROM video_longo) AS total;";
        $total = $this->db->runSQL($sql)->fetchAll();
        $soma = 0;
        foreach ($total as $parte) {
            foreach ($parte as $key => $value) {
                $soma += $value;
            }
        }
        return $soma;
    }

    public function getMoreContents() {
        $sql = "SELECT * 
                FROM (
                    SELECT
                    r.id,
                    r.titulo,
                    r.descricao,
                    r.imagem_file AS file,
                    r.seo_title,
                    r.data,
                    'receita' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = r.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = r.id) AS opinioes

                    FROM receita AS r

                    JOIN categoria AS c ON r.categoria_id = c.id
                    JOIN membro AS m ON r.membro_id = m.id
                    
                    
                UNION ALL
                
                
                 SELECT 
                    q.id,
                    q.titulo,
                    q.descricao,
                    q.youtube_id AS file,
                    q.seo_title,
                    q.data,
                    'quik' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = q.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = q.id) AS opinioes

                    FROM quik AS q

                    JOIN membro AS m ON q.membro_id = m.id
                
                
                
                UNION ALL
                
                
                SELECT
                    p.id, 
                    NULL as titulo,
                    p.descricao,
                    p.imagem_file AS file,
                    NULL as seo_title,
                    p.data,
                    'publicação' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = p.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = p.id) AS opinioes

                    FROM publicacao_simples AS p

                    JOIN membro AS m ON m.id = p.membro_id
                    
                    
                UNION ALL
                
                
                SELECT
                    v.id,
                    v.titulo,
                    v.descricao,
                    v.youtube_id AS file,
                    v.seo_title,
                    v.data,
                    'vídeo longo' AS tipo_conteudo,
                    CONCAT(m.forename, ' ', m.surname) AS autor,

                    (SELECT COUNT(conteudo_id)
                    FROM likes
                    WHERE likes.conteudo_id = v.id) AS likes,
                    (SELECT COUNT(conteudo_id)
                    FROM opiniao
                    WHERE opiniao.conteudo_id = v.id) AS opinioes

                    FROM video_longo AS v

                    JOIN membro AS m ON m.id = v.membro_id) AS data
            ORDER BY RAND()
            LIMIT 15;";

        return $this->db->runSQL($sql)->fetchAll();
    }

    public function getMemberIdByContentId($id) {
        $arguments['id1'] = $id;
        $arguments['id2'] = $id;
        $arguments['id3'] = $id;
        $arguments['id4'] = $id;

        $sql = "SELECT m.id 
                FROM membro AS m
                
                LEFT JOIN receita AS r ON r.membro_id = m.id
                LEFT JOIN publicacao_simples AS p ON p.membro_id = m.id
                LEFT JOIN quik AS q ON q.membro_id = m.id
                LEFT JOIN video_longo AS v ON v.membro_id = m.id
                
                WHERE r.id = :id1
                OR p.id = :id2
                OR q.id = :id3
                OR v.id = :id4;";
        return $this->db->runSQL($sql, $arguments)->fetchColumn();
    }

    public function createView($id, $session) {
        $arguments['session'] = $session;
        $arguments['id'] = $id;

        $sql = "INSERT INTO views (membro_id, conteudo_id)
                VALUES (:session, :id);";
        $this->db->runSQL($sql, $arguments);
    }
}