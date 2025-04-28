<?php
use TiagoDaniel\Validate\Validate;

require_login($session);

$keywords = [];
$Thumbdestination = '';

$pathVideos = APP_ROOT . '/public/quiks/';

$quik = [
    'id' => $id,
    'titulo' => '',
    'descricao' => '',
    'receita_acoplada_id' => '',
    'video_file' => '',
    'keywords' => '',
    'membro_id' => $session->id,
];

$erros = [
    'warning' => '',
    'titulo' => '',
    'descricao' => '',
    'video_file' => '',
    'keywords' => '',
];

if ($id) {
    $quik = $cms->getQuik()->get($id);
    if (!$quik) {
        redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['failure' => 'Quik não encontrado']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $videoTemp = $_FILES['video']['tmp_name'] ?? null;

    if ($videoTemp && $_FILES['video']['error'] == 0) {
        $quik['video_file'] = create_filename($_FILES['video']['name'], $pathVideos);
        $Videodestination = $pathVideos . $quik['video_file'];

        if (!move_uploaded_file($videoTemp, $Videodestination)) {
            die('Erro ao mover o vídeo');
        }
    } elseif ($videoTemp != null) {
        $erros['video_file'] = 'Erro ao carregar o vídeo';
    }

    $quik['titulo'] = $_POST['titulo'];
    $quik['descricao'] = $_POST['descricao'];

    $quant_keywords = $_POST['quant_keywords'];

    for ($c = 1; $c <= $quant_keywords; $c++) {
        $keywords[] = preg_replace('/#/', '', $_POST["tag$c"]);
    }

    $quik['keywords'] = implode('#', $keywords);
    $quik['seo_title'] = create_seo_name($quik['titulo']);

    $erros['titulo'] = Validate::isText($quik['titulo'], 0 , 256) ? '' : 'A descrição deve ter entre 0 e 2000 caracteres';
    $erros['descricao'] = Validate::isText($quik['descricao'], 0 , 4000) ? '' : 'A descrição deve ter entre 0 e 2000 caracteres';

    $invalid = implode($erros);
    if ($invalid) {
        $erros['warning'] = 'Por favor corrige os erros';
    } else {
        $client = new Google\Client();
        $client->setAuthConfig('../client_secret.json');
        $client->setRedirectUri('http://localhost:8888/the-cooking-place-front-e-back-end/v10/public/callback/'); 
        $client->addScope(Google\Service\YouTube::YOUTUBE_UPLOAD);
        $client->setAccessType('offline');

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

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $newToken = $client->getAccessToken();
            $cms->getMyYouTube()->delete();
            $cms->getMyYouTube()->insert($newToken['access_token'], $newToken['refresh_token'], $newToken['expires_in']);
        }

        $youtube = new Google\Service\YouTube($client);

        $snippet = new Google\Service\YouTube\VideoSnippet();
        $snippet->setTitle($quik['titulo']);
        $snippet->setDescription($quik['descricao']);
        if (!empty($video['keywords'])) {
            $snippet->setTags($keywords);
        }
        $snippet->setCategoryId('26');

        $status = new Google\Service\YouTube\VideoStatus();
        $status->privacyStatus = 'unlisted';
        $status->setSelfDeclaredMadeForKids = false;
        $status->madeForKids = false;

        $youtube_video = new Google\Service\YouTube\Video();
        $youtube_video->setSnippet($snippet);
        $youtube_video->setStatus($status);

        if (!$id) {
            $client->setDefer(true);

            $request = $youtube->videos->insert('status,snippet', $youtube_video);

            $media = new Google\Http\MediaFileUpload(
                $client,
                $request,
                mime_content_type($Videodestination),
                null,
                true,
                1024 * 1024
            );

            $media->setFileSize(filesize($Videodestination));

            $handle = fopen($Videodestination, 'rb');
            $status = false;

            while (!$status && !feof($handle)) {
                $chunk = fread($handle, 1024 * 1024);
                $status = $media->nextChunk($chunk);
            }
            fclose($handle);
            $client->setDefer(false);
            
            unlink($Videodestination);

            $cms->getQuik()->create($quik['titulo'], $quik['descricao'], 0, $quik['keywords'], $quik['seo_title'], $status['id'], $quik['membro_id']);

            redirect(DOC_ROOT . 'profile/' . $quik['membro_id'] . '/', ['success' => 'Quik Publicado']);
        } else {   
            $client->setScopes([
                'https://www.googleapis.com/auth/youtube',
                'https://www.googleapis.com/auth/youtube.upload',
                'https://www.googleapis.com/auth/youtube.force-ssl'
            ]);
            
            $videoId = $cms->getQuik()->get($id)['youtube_id'];
            $videoResponse = $youtube->videos->listVideos('snippet,status', ['id' => $videoId]);
            $items = $videoResponse->getItems();

            if (count($items) === 0) {
                echo "Vídeo não encontrado!";
                exit;
            }

            $cms->getQuik()->update($quik['titulo'], $quik['descricao'], 0,  $quik['keywords'], $quik['seo_title'], $id);

            $youtube_video = $items[0]; // é um Google\Service\YouTube\Video

            // Altera os dados
            $snippet = new Google\Service\YouTube\VideoSnippet();
            $snippet = $youtube_video->getSnippet();
            $snippet->setTitle($quik['titulo']);
            $snippet->setDescription($quik['descricao']);
            $snippet->setTags($quik['keywords']);

            $status = $youtube_video->getStatus();
            $status->setPrivacyStatus("unlisted"); // opcional

            $youtube_video->setSnippet($snippet);
            $youtube_video->setStatus($status);

            // Atualiza o vídeo
            $updateResponse = $youtube->videos->update("snippet,status", $youtube_video);

            redirect(DOC_ROOT . 'profile/' . $quik['membro_id'] . '/', ['success' => 'Quik Atualizado']);
        }
    }
}

$data['quik'] = $quik;
$data['keywords'] = explode('#', $quik['keywords']);
$data['count_keywords'] = count($data['keywords']);

echo $twig->render('create-edit-quik.html', $data);