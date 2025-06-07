<?php
require_once 'vendor/autoload.php';
require_once 'src/bootstrap.php';

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use TiagoDaniel\CMS\WebSocket;

$pdo = $cms->getDatabase();
$session = $cms->getSession();

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocket($session, $pdo)
        )
    ),
    8080
);

echo "WebSocket server started running on port 8080\n"; 
$server->run();