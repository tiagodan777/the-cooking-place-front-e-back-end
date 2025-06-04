<?php
require_once '../src/bootstrap.php'; // ajuste caminho se necessário

require_login($session);

header('Content-Type: application/json');

echo json_encode([
    'user_id' => $session->id ?? null,
]);