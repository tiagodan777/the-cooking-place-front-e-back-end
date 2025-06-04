<?php
namespace TiagoDaniel\CMS;

class Cookie {
    private $db;
    public $token;

    public function __construct($db)
    {   
        $this->db = $db;
        $this->token = $_COOKIE['token'] ?? '';
    }

    public function create($member) {
        $arguments['token'] = bin2hex(random_bytes(64));
        $arguments['expires'] = date('Y-m-d H:i:s', strtotime('+7 days'));
        $arguments['member_id'] = $member['id'];
        $arguments['purpose'] = 'stay_logged_id';

        $sql = "INSERT INTO token (token, expires, member_id, purpose)
                VALUES (:token, :expires, :member_id, :purpose);";
        $this->db->runSQL($sql, $arguments);

        setcookie('token', $arguments['token'], time() + 60 * 60 * 24 * 7, '/', '', false, true);

        return $arguments['token'];
    }

    public function updade($member) {
        $this->create($member);
    }

    public function delete() {
        $sql = "DELETE FROM token
                WHERE token = :token;";
        $this->db->runSQL($sql, [$_COOKIE['token']]);
        setcookie('token', '', time() - 3600, '/', '', false, true);
    }
}
