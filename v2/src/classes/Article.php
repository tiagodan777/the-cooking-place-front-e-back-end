<?php
class Article {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT r.id, r.titulo, r.descricao, r.data, r.tempo_preparo, r.unidade_tempo, 
                r.numero_pessoas, r.ingredientes, r.quantidades, r.passos_preparacao, r.keywords, 
                r.imagem_file, r.video_file, r.categoria_id, r.membro_id, c.nome, m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture
                FROM receita AS r
                JOIN categoria AS c ON r.categoria_id = c.id
                JOIN membro AS m ON r.membro_id = m.id
                WHERE r.id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    /*public function get($id) {
        $sql = "SELECT r.id, r.titulo, r.descricao, r.data, r.tempo_preparo, r.unidade_tempo, 
                r.numero_pessoas, r.ingredientes, r.quantidades, r.passos_preparacao, r.keywords, 
                r.imagem_file, r.categoria_id, r.membro_id, c.nome, m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture
                FROM receita AS r
                JOIN categoria AS c ON r.categoria_id = c.id
                JOIN membro AS m ON r.membro_id = m.id
                WHERE r.id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }*/

    public function getAll($category = null, $member = null) {
        $arguments['categoria'] = $category;
        $arguments['categoria1'] = $category;
        $arguments['membro'] = $member;
        $arguments['membro1'] = $member;
        $sql = "SELECT r.id, r.titulo, r.descricao, r.data, r.imagem_file, r.membro_id,
                CONCAT(m.forename, ' ', m.surname) AS autor,
                m.picture 
                FROM receita AS r
                JOIN membro AS m ON r.membro_id = m.id
                WHERE (r.categoria_id = :categoria OR :categoria1 IS null)
                AND (r.membro_id = :membro OR :membro1 IS null)
                ORDER BY id ASC;";
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
                OR m.surname LIKE :term8;";

        return $this->db->runSQL($sql, $arguments)->fetchColumn();
    }

    public function search($term, $show, $from) {
        $arguments['term1'] = '%' . $term . '%';
        $arguments['term2'] = '%' . $term . '%';
        $arguments['term3'] = '%' . $term . '%';
        $arguments['term4'] = '%' . $term . '%';
        $arguments['term5'] = '%' . $term . '%';
        $arguments['term6'] = '%' . $term . '%';
        $arguments['term7'] = '%' . $term . '%';
        $arguments['term8'] = '%' . $term . '%';
        $arguments['show'] = $show;
        $arguments['from'] = $from;

        $sql = "SELECT r.id, r.titulo, r.descricao, r.imagem_file,
                CONCAT(m.forename, ' ', m.surname) AS autor
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
                LIMIT :show
                OFFSET :from;";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }

    public function count() {
        $sql = "SELECT COUNT(*) FROM receita;";

        return $this->db->runSQL($sql)->fetchColumn();
    }

    public function create($article, $temp, $destination) {
        try {
            if ($temp) {
                $imagick = new Imagick($temp);
                $imagick->cropThumbnailImage(500, 500);
                $imagick->writeImage($destination);
            }

            $sql = "INSERT INTO receita (titulo, descricao, tempo_preparo, unidade_tempo, numero_pessoas, ingredientes, quantidades, passos_preparacao, keywords, categoria_id, membro_id, imagem_file) VALUES
                    (:titulo, :descricao, :tempo_preparo, :unidade_tempo, :numero_pessoas, :ingredientes, :quantidades, :passos_preparacao, :keywords, :categoria_id, :membro_id, :imagem_file);";

            $this->db->runSQL($sql, $article);
            return true;
        } catch (Exception $e) {
            if (file_exists($destination)) {
                unlink($destination);
            }
            throw $e;
        }
    }

    public function update($article, $temp, $destination) {
        try {
            if ($temp) {
                $imagick = new Imagick($temp);
                $imagick->cropThumbnailImage(500, 500);
                $imagick->writeImage($destination);
            }

            $sql = "UPDATE receita SET titulo = :titulo, descricao = :descricao, tempo_preparo = :tempo_preparo, unidade_tempo = :unidade_tempo, numero_pessoas = :numero_pessoas, ingredientes = :ingredientes,
                    quantidades = :quantidades, passos_preparacao = :passos_preparacao, keywords = :keywords, categoria_id = :categoria_id, membro_id = :membro_id, imagem_file = :imagem_file
                    WHERE id = :id;";

            $this->db->runSQL($sql, $article);
            return true;
        } catch (Exception $e) {
            if (file_exists($destination)) {
                unlink($destination);
            }
            throw $e;
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM receita WHERE id = :id;";

        $this->db->runSQL($sql, [$id]);
        return true;
    }

    public function imageDelete($id, $path) {
        $sql = "SELECT imagem_file FROM receita WHERE id = :id";
        $file = $this->db->runSQL($sql, [$id])->fetchColumn();

        echo $path;

        if (file_exists($path)) {
            unlink($path);
        }

        $sql = "UPDATE receita SET imagem_file = null WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
        return true;
    }
}