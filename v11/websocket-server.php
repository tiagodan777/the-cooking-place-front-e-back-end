<?php
require_once 'vendor/autoload.php';

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use TiagoDaniel\CMS\WebSocket;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocket()
        )
    ),
    8080
);

echo "WebSocket server started running on port 8080\n"; 
$server->run();