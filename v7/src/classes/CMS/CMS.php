<?php
namespace TiagoDaniel\CMS;

class CMS {
    protected $db = null;
    protected $article = null;
    protected $category = null;
    protected $member = null;
    protected $notification = null;
    protected $quik = null;
    protected $cookie = null;
    protected $token = null;
    protected $like = null;
    protected $opinion = null;
    protected $follow = null;
    protected $content = null;

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

    public function getCookie() {
        if ($this->cookie === null) {
            $this->cookie = new Cookie($this->db);
        }
        return $this->cookie;
    }

    public function getToken() {
        if ($this->token === null) {
            $this->token = new Token($this->db);
        }
        return $this->token;
    }

    public function getLike() {
        if ($this->like === null) {
            $this->like = new Like($this->db);
        }
        return $this->like;
    }

    public function getOpinion() {
        if ($this->opinion === null) {
            $this->opinion = new Opinion($this->db);
        }
        return $this->opinion;
    }

    public function getFollow() {
        if ($this->follow === null) {
            $this->follow = new Follow($this->db);
        }
        return $this->follow;
    }

    public function getContent() {
        if ($this->content === null) {
            $this->content = new Content($this->db);
        }
        return $this->content;
    }
}