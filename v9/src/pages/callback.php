<?php

$client = new Google\Client();
$client->setAuthConfig('../client_secret.json');
$client->setRedirectUri('http://localhost:8888/the-cooking-place-front-e-back-end/v9/public/callback/'); 
$client->addScope(Google\Service\YouTube::YOUTUBE_UPLOAD);

if (!isset($_GET['code'])) {
    die('Código de autorização não rebido');
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    die('Erro ao receber token: ' . $token['error_description']);
}

$youtube = $cms->getMyYouTube();
$youtube->delete();
$youtube->insert($token['access_token'], $token['refresh_token'], $token['expires_in']);

echo "✅ Token salvo com sucesso! Agora pode usar o upload.php sem autenticação.";

