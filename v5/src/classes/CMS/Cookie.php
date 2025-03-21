<?php
namespace TiagoDaniel\CMS;

class Cookie {
    public $id, $forename, $picture, $role;

    public function __construct()
    {   
        $this->id = $_COOKIE['id'] ?? 0;
        $this->forename = $_COOKIE['forename'] ?? '';
        $this->picture = $_COOKIE['picture'] ?? '';
        $this->role = $_COOKIE['role'] ?? 'public';
    }

    public function create($member) {
        setcookie('id', $member['id'], time() + 60 * 60 * 24 * 7, '/', '', false, true);
        setcookie('forename', $member['forename'], time() + 60 * 60 * 24 * 7, '/', '', false, true);
        setcookie('picture', $member['picture'], time() + 60 * 60 * 24 * 7, '/', '', false, true);
        setcookie('role', $member['role'], time() + 60 * 60 * 24 * 7, '/', '', false, true);
        setcookie('user_nick_name', $member['user_nick_name'], time() + 60 * 60 * 24 * 7, '/', '', false, true);
    }

    public function uptade($member) {
        $this->create($member);
    }

    public function delete() {
        setcookie('id', '', time() - 3600, '/', '', false, true);
        setcookie('forename', '', time() - 3600,  '/', '', false, true);
        setcookie('picture', '', time() - 3600,  '/', '', false, true);
        setcookie('role', '', time() - 3600,  '/', '', false, true);
    }
}
