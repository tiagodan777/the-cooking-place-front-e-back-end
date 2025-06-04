<?php
namespace TiagoDaniel\CMS;

class Article {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT r.id, r.titulo, r.descricao, r.data, r.tempo_preparo, r.unidade_tempo, 
                r.numero_pessoas, r.ingredientes, r.quantidades, r.passos_preparacao, r.keywords, 
                r.imagem_file, r.video_longo_file, r.quik_file, r.categoria_id, r.membro_id, r.seo_title,
                c.nome,
                m.id AS id_membro,CONCAT(m.forename, ' ', m.surname) AS autor, m.picture, m.seo_name AS seo_member,
                (SELECT COUNT(conteudo_id)
                FROM likes
                WHERE likes.conteudo_id = r.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = r.id) AS opinioes
                FROM receita AS r
                JOIN categoria AS c ON r.categoria_id = c.id
                JOIN membro AS m ON r.membro_id = m.id
                WHERE r.id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function getAll($category = null, $member = null) {
        $arguments['categoria'] = $category;
        $arguments['categoria1'] = $category;
        $arguments['membro'] = $member;
        $arguments['membro1'] = $member;
        $sql = "SELECT r.id, r.titulo, r.descricao, r.data, r.imagem_file, r.membro_id, r.seo_title,
                CONCAT(m.forename, ' ', m.surname) AS autor,
                m.picture, m.seo_name AS seo_member,
                (SELECT COUNT(conteudo_id)
                FROM likes
                WHERE likes.conteudo_id = r.id) AS likes,
                (SELECT COUNT(conteudo_id)
                FROM opiniao
                WHERE opiniao.conteudo_id = r.id) AS opinioes
                FROM receita AS r
                JOIN membro AS m ON r.membro_id = m.id
                WHERE (r.categoria_id = :categoria OR :categoria1 IS null)
                AND (r.membro_id = :membro OR :membro1 IS null)
                ORDER BY id DESC;";
        return $this->db->runSQL($sql, $arguments)->fetchAll();
    }

    public function count() {
        $sql = "SELECT COUNT(*) FROM receita;";

        return $this->db->runSQL($sql)->fetchColumn();
    }

    public function create($article, $temp, $destination, $destination_cropped_500, $destination_cropped_600, $destination_cropped_700) {
        try {
            // Original
            $converted = sys_get_temp_dir() . '/' . uniqid('img_', true) . '.jpg';
            $output = [];
            $return_var = 0;
            $magick = '/opt/homebrew/bin/magick';
            exec($magick . ' ' . escapeshellarg($temp) . " " . escapeshellarg($converted), $output, $return_var);

            if (!file_exists($converted)) {
                throw new \Exception("Falha ao converter imagem HEIC. Saída: " . implode("\n", $output));
            }

            $imagick = new \Imagick($converted);
            $imagick->setImageCompressionQuality(85);
            $imagick->setImageFormat('jpeg');
            $imagick->cropThumbnailImage(800, 800);
            $imagick->setImageResolution(72, 72);
            $imagick->resampleImage(72, 72, \Imagick::FILTER_LANCZOS, 1);
            $imagick->stripImage();
            $imagick->writeImage($destination);
            $imagick->clear();
            unlink($converted);

            // 500
            $converted = sys_get_temp_dir() . '/' . uniqid('img_', true) . '.jpg';
            $output = [];
            $return_var = 0;
            $magick = '/opt/homebrew/bin/magick';
            exec($magick . ' ' . escapeshellarg($temp) . " " . escapeshellarg($converted), $output, $return_var);

            if (!file_exists($converted)) {
                throw new \Exception("Falha ao converter imagem HEIC. Saída: " . implode("\n", $output));
            }

            $imagick_cropped_500 = new \Imagick($converted);
            $imagick_cropped_500->setImageCompressionQuality(85);
            $imagick_cropped_500->setImageFormat('jpeg');
            $imagick_cropped_500->cropThumbnailImage(800, 800); ;
            $imagick_cropped_500->setImageResolution(72, 72);
            $imagick_cropped_500->resampleImage(72, 72, \Imagick::FILTER_LANCZOS, 1);
            $imagick_cropped_500->stripImage();
            $imagick_cropped_500->writeImage($destination_cropped_500);
            $imagick_cropped_500->clear();
            unlink($converted);

            // 600
            $converted = sys_get_temp_dir() . '/' . uniqid('img_', true) . '.jpg';
            $output = [];
            $return_var = 0;
            $magick = '/opt/homebrew/bin/magick';
            exec($magick . ' ' . escapeshellarg($temp) . " " . escapeshellarg($converted), $output, $return_var);

            if (!file_exists($converted)) {
                throw new \Exception("Falha ao converter imagem HEIC. Saída: " . implode("\n", $output));
            }

            $imagick_cropped_600 = new \Imagick($converted);
            $imagick_cropped_600->setImageCompressionQuality(85);
            $imagick_cropped_600->setImageFormat('jpeg');
            $imagick_cropped_600->cropThumbnailImage(800, 800); 
            $imagick_cropped_600->setImageResolution(72, 72);
            $imagick_cropped_600->resampleImage(72, 72, \Imagick::FILTER_LANCZOS, 1);
            $imagick_cropped_600->stripImage();
            $imagick_cropped_600->writeImage($destination_cropped_600);
            $imagick_cropped_600->clear();
            unlink($converted);

            // 700
            $converted = sys_get_temp_dir() . '/' . uniqid('img_', true) . '.jpg';
            $output = [];
            $return_var = 0;
            $magick = '/opt/homebrew/bin/magick';
            exec($magick . ' ' . escapeshellarg($temp) . " " . escapeshellarg($converted), $output, $return_var);

            if (!file_exists($converted)) {
                throw new \Exception("Falha ao converter imagem HEIC. Saída: " . implode("\n", $output));
            }

            $imagick_cropped_700 = new \Imagick($converted);
            $imagick_cropped_700->setImageCompressionQuality(85);
            $imagick_cropped_700->setImageFormat('jpeg');
            $imagick_cropped_700->cropThumbnailImage(800, 800); 
            $imagick_cropped_700->setImageResolution(72, 72);
            $imagick_cropped_700->resampleImage(72, 72, \Imagick::FILTER_LANCZOS, 1);
            $imagick_cropped_700->stripImage();
            $imagick_cropped_700->writeImage($destination_cropped_700);
            $imagick_cropped_700->clear();
            unlink($converted);

            $sql = "INSERT INTO receita (titulo, descricao, tempo_preparo, unidade_tempo, numero_pessoas, ingredientes, quantidades, passos_preparacao, keywords, categoria_id, membro_id, imagem_file, seo_title) VALUES
                    (:titulo, :descricao, :tempo_preparo, :unidade_tempo, :numero_pessoas, :ingredientes, :quantidades, :passos_preparacao, :keywords, :categoria_id, :membro_id, :imagem_file, :seo_title);";

            $this->db->runSQL($sql, $article);
            return true;
        } catch (\Exception $e) {
            if (file_exists($destination)) {
                unlink($destination);
            }
            throw $e;
        }
    }

    public function update($article, $temp, $destination) {
        try {
            if ($temp) {
                $imagick = new \Imagick($temp);
                $imagick->cropThumbnailImage(500, 500);
                $imagick->writeImage($destination);
            }

            $sql = "UPDATE receita SET titulo = :titulo, descricao = :descricao, tempo_preparo = :tempo_preparo, unidade_tempo = :unidade_tempo, numero_pessoas = :numero_pessoas, ingredientes = :ingredientes,
                    quantidades = :quantidades, passos_preparacao = :passos_preparacao, keywords = :keywords, categoria_id = :categoria_id, membro_id = :membro_id, imagem_file = :imagem_file, seo_title = :seo_title
                    WHERE id = :id;";

            $this->db->runSQL($sql, $article);
            return true;
        } catch (\Exception $e) {
            if (file_exists($destination)) {
                unlink($destination);
            }
            throw $e;
        }
    }

    public function delete($id) {
        try {
            $this->db->beginTransaction();

            $sql = "DELETE FROM likes WHERE conteudo_id = :id;";
            $this->db->runSQL($sql, [$id]);

            $sql = "DELETE FROM opiniao WHERE conteudo_id = :id;";
            $this->db->runSQL($sql, [$id]);

            $sql = "DELETE FROM receita WHERE id = :id;";
            $this->db->runSQL($sql, [$id]);

            $this->db->commit();

            return true;
        } catch(\PDOException $e) {
            $this->db->rollBack();

            throw $e;
        }
    }

    public function imageDelete($id, $path) {
        $sql = "SELECT imagem_file FROM receita WHERE id = :id";
        $file = $this->db->runSQL($sql, [$id])->fetchColumn();

        $path .= $file;

        if (file_exists($path)) {
            unlink($path);
        }

        $sql = "UPDATE receita SET imagem_file = '' WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
        return true;
    }
}