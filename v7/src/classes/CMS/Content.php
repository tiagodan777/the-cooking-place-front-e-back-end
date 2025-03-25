<?php
namespace TiagoDaniel\CMS;

class Content {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

}