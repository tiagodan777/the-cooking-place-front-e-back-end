<?php
define('DEV', true);
define("DOC_ROOT", '/the-cooking-place-front-e-back-end/v11/public/');
define("ROOT_FOLTER", 'public');
define('DOMAIN', 'http://localhost:8888'); 

$type = 'mysql';
$server = 'localhost';
$db = 'the-cooking-place';
$port = '8889';
$charset = 'utf8mb4';
$username = 'reisupremo';
$password = 'Tiago1234';
$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

$email_config = [
    'server' => 'smtp.sendgrid.net',
    'port' => '587',
    'username' => 'apikey',
    'password' => '',
    'security' => 'tls',
    'admin_email' => 'tiagoamdaniel488@gmail.com',
    'debug' => (DEV) ? 2 : 0,
];

define('MEDIA_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/heic']);
define('FILE_EXTENSIONS', ['jpeg', 'jpg', 'png', 'gif', 'webp', 'heic']);
define('MAX_SIZE', '12000000');
define('UPLOADS', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . ROOT_FOLTER . DIRECTORY_SEPARATOR . 'imagens' . DIRECTORY_SEPARATOR . 'comida' . DIRECTORY_SEPARATOR);
define('UPLOADS_CROPPED_500', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . ROOT_FOLTER . DIRECTORY_SEPARATOR . 'imagens' . DIRECTORY_SEPARATOR . 'comida' . DIRECTORY_SEPARATOR . 'cropped_500' . DIRECTORY_SEPARATOR);
define('UPLOADS_CROPPED_600', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . ROOT_FOLTER . DIRECTORY_SEPARATOR . 'imagens' . DIRECTORY_SEPARATOR . 'comida' . DIRECTORY_SEPARATOR . 'cropped_600' . DIRECTORY_SEPARATOR);
define('UPLOADS_CROPPED_700', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . ROOT_FOLTER . DIRECTORY_SEPARATOR . 'imagens' . DIRECTORY_SEPARATOR . 'comida' . DIRECTORY_SEPARATOR . 'cropped_700' . DIRECTORY_SEPARATOR);



