<?php
class Article {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($id) {
        $sql = "SELECT r.id, r.titulo, r.descricao, r.data, r.tempo_preparo, r.unidade_tempo, 
                r.numero_pessoas, r.ingredientes, r.quantiades, r.passos_preparacao, r.keywords, 
                r.imagem_file, c.nome, m.id, CONCAT(m.forename, ' ', m.surname) AS autor, m.picture
                FROM receita AS r
                JOIN categoria AS c ON r.categoria_id = c.id
                JOIN membro AS m ON r.membro_id = m.id
                WHERE id = :id;";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function getAll() {
        $sql = "SELECT r.id, r.titulo, r.descricao, r.imagem_file, m.id
                CONCAT(m.forename, ' ', m.surname) AS autor,
                m.picture
                FROM receita AS r
                JOIN membro AS m ON r.membro_id = r.id;";
        return $this->db->runSQL($sql)->fetchAll();
    }
}