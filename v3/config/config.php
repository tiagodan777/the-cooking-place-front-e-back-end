<?php
define('DEV', true);
define("DOC_ROOT", '/the-cooking-place-front-e-back-end/v3/public/');
define("ROOT_FOLTER", 'public');

$type = 'mysql';
$server = 'localhost';
$db = 'the-cooking-place-testes';
$port = '8889';
$charset = 'utf8mb4';
$username = 'reisupremo';
$password = 'Tiago1234';
$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

define('MEDIA_TYPES', ['image/jpeg', 'image/png', 'image/gif',]);
define('FILE_EXTENSIONS', ['jpeg', 'jpg', 'png', 'gif',]);
define('MAX_SIZE', '5248800');
define('UPLOADS', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . ROOT_FOLTER . DIRECTORY_SEPARATOR . 'imagens' . DIRECTORY_SEPARATOR . 'comida' . DIRECTORY_SEPARATOR);
