<?php
namespace TiagoDaniel\CMS;

class Session {
    private $db;
    public $id, $forename, $picture, $role, $seo_name, $token;

    public function __construct($db)
    {   
        session_start();
        $this->db = $db;
        $token = $_COOKIE['token'] ?? '';
        if ($token) {
            /*echo "<pre>";
            var_dump($_COOKIE);*/
            $this->create($token, 'stay_logged_id');
            /*var_dump($_SESSION);
            echo "</pre>";*/
        }
        $this->id = $_SESSION['id'] ?? 0;
        $this->forename = $_SESSION['forename'] ?? '';
        $this->picture = $_SESSION['picture'] ?? '';
        $this->role = $_SESSION['role'] ?? 'member';
        $this->seo_name = $_SESSION['seo_name'] ?? '';
        $this->token = $_SESSION['token'] ?? '';
    }

    public function create($token, $purpose = 'stay_logged_id') {
        session_regenerate_id(true);
        $arguments = [];
        $sql = "SELECT member_id FROM token
                WHERE token = :token AND purpose = :purpose AND expires > NOW()";
        $member_id = $this->db->runSQL($sql, ['token' => $token, 'purpose' => $purpose])->fetch();

        if (!$member_id) {
            // Token inválido → não atualiza a sessão
            return;
        }

        $sql = "SELECT id, forename, picture, role, seo_name
                FROM membro
                WHERE id = :member_id;";
        $arguments = $this->db->runSQL($sql, $member_id)->fetch();

        $_SESSION['id'] = $arguments['id'];
        $_SESSION['forename'] = $arguments['forename'];
        $_SESSION['picture'] = $arguments['picture'];
        $_SESSION['role'] = $arguments['role'];
        $_SESSION['seo_name'] = $arguments['seo_name'];
        $_SESSION['token'] = $token;
    }

    public function update($token) {
        $this->create($token);
    }

    public function delete() {
        $_SESSION = [];
        $param = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $param['path'], $param['domain'], $param['secure'], $param['httponly']);
        session_destroy();
    }
}