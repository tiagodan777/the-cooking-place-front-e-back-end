<?php
namespace TiagoDaniel\CMS;

class MyYouTube {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get() {
        $sql = "SELECT * FROM youtube_tokens;";

        return $this->db->runSQL($sql)->fetch();
    }

    public function insert($access_token, $refresh_token, $expires_in) {
        $sql = "INSERT INTO youtube_tokens (access_token, refresh_token, expires_in)
                VALUES (:access_token, :refresh_token, :expires_in);";
        $this->db->runSQL($sql, [$access_token, $refresh_token, $expires_in]);
    }

    public function delete() {
        $sql = "DELETE FROM youtube_tokens";

        $this->db->runSQL($sql);
    }
}