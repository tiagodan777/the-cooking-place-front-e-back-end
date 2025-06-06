<?php
require_login($session);

if (!$id) {
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['failure' => 'Vídeo não encontrado']);
}

$quik = $cms->getQuik()->get($id);
if (!$quik) {
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['failure' => 'Vídeo não encontrado']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client = new Google\Client();
    $client->setAuthConfig('../client_secret.json');
    $client->addScope('https://www.googleapis.com/auth/youtube.force-ssl');
    $row = $cms->getMyYouTube()->get();
        if (!$row) {
            die('Token do YouTube não encontrado. Faz login como admin');
        }

        $token = [
            'access_token' => $row['access_token'],
            'refresh_token' => $row['refresh_token'],
            'expires_in' => $row['expires_in'],
            'created_at' => strtotime($row['created_at']),
        ];

    $client->setAccessToken($token);

    $youtube = new Google_Service_Youtube($client);

    $quikId = $quik['youtube_id'];

    try {
        $youtube->videos->delete($quikId);
    } catch (Google_Service_Exception $e) {
        echo "Erro na API: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Erro de escopo geral: " . $e->getMessage();
    }
    $cms->getQuik()->delete($id);
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['success' => 'Vídeo apagado com sucesso']);
}

$data['quik'] = $quik;

echo $twig->render('quik-delete.html', $data);
