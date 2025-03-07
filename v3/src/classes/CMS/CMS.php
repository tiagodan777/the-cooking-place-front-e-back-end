<?php
namespace TiagoDaniel\CMS;

class CMS {
    protected $db = null;
    protected $article = null;
    protected $category = null;
    protected $member = null;
    protected $notification = null;
    protected $quik = null;

    public function __construct($dsn, $username, $password)
    {
        $this->db = new Database($dsn, $username, $password);        
    }

    public function getArticle() {
        if ($this->article === null) {
            $this->article = new Article($this->db);
        }
        return $this->article;
    }

    public function getCategory() {
        if ($this->category === null) {
            $this->category = new Category($this->db);
        }
        return $this->category;
    }

    public function getMember() {
        if ($this->member === null) {
            $this->member = new Member($this->db);
        }
        return $this->member;
    }

    public function getNotification() {
        if ($this->notification === null) {
            $this->notification = new Notification($this->db);
        }
        return $this->notification;
    }

    public function getQuik() {
        if ($this->quik === null) {
            $this->quik = new Quik($this->db);
        }
        return $this->quik;
    }
}