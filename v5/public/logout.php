<?php
require_once '../src/bootstrap.php';

$cms->getCookie()->delete();
redirect('index.php');