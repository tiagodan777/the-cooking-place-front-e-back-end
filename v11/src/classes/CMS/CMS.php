<?php
namespace TiagoDaniel\CMS;

class CMS {
    protected $db = null;
    private $article = null;
    private $category = null;
    private $member = null;
    // private $notification = null;
    private $quik = null;
    private $cookie = null;
    private $token = null;
    private $like = null;
    private $opinion = null;
    private $follow = null;
    private $content = null;
    private $post = null;
    private $long_video = null;
    private $saved = null;
    private $session = null;
    private $my_youtube = null;

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

    /*public function getNotification() {
        if ($this->notification === null) {
            $this->notification = new Notification($this->db);
        }
        return $this->notification;
    }*/

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

    /*public function getLike() {
        if ($this->like === null) {
            $this->like = new Like($this->db);
        }
        return $this->like;
    }*/

    public function getOpinion() {
        if ($this->opinion === null) {
            $this->opinion = new Opinion($this->db);
        }
        return $this->opinion;
    }

    public function getFollow() {
        if ($this->follow === null) {
            $this->follow = new Follow($this->db, null);
        }
        return $this->follow;
    }

    public function getContent() {
        if ($this->content === null) {
            $this->content = new Content($this->db);
        }
        return $this->content;
    }

    public function getPost() {
        if ($this->post === null) {
            $this->post = new Post($this->db);
        }
        return $this->post;
    }

    public function getLongVideo() {
        if ($this->long_video === null) {
            $this->long_video = new LongVideo($this->db);
        }
        return $this->long_video;
    }

    public function getSaved($pdo, $session) {
        if ($this->saved === null) {
            $this->saved = new Saved($pdo, $session);
        }
        return $this->saved;
    }

    public function getSession() {
        if ($this->session === null) {
            $this->session = new Session($this->db);
        }
        return $this->session;
    }

    public function getMyYouTube() {
        if ($this->my_youtube === null) {
            $this->my_youtube = new MyYouTube($this->db);
        }
        return $this->my_youtube;
    }

    public function getDatabase() {
        return $this->db;
    }
}