<?php

$client = new Google\Client();
$client->setAuthConfig('../client_secret.json');
$client->setRedirectUri('http://localhost:8888/the-cooking-place-front-e-back-end/v9/public/callback/'); 
$client->addScope(Google\Service\YouTube::YOUTUBE_UPLOAD);
$client->setAccessType('offline');
$client->setPrompt('consent'); // para garantir que o refresh_token seja enviado

$authUrl = $client->createAuthUrl();

echo "<a href='$authUrl'>Fazer login com conta do YouTube</a>";
