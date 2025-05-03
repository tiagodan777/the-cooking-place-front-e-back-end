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

    public function create($post, $temp, $destination, $destination_cropped_500, $destination_cropped_600, $destination_cropped_700) {
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

    public function imageDelete($id, $path) {
        $sql = "SELECT imagem_file FROM publicacao_simples
                WHERE id = :id;";
        $file = $this->db->runSQL($sql, [$id])->fetch();

        $path .= $file;
        if (file_exists($path)) {
            unlink($path);
        }

        $sql = "UPDATE publicacao_simples
                SET imagem_file = ''
                WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM publicacao_simples
                WHERE id = :id;";
        $this->db->runSQL($sql, [$id]);
        return true;
    }
}