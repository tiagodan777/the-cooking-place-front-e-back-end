<?php
use TiagoDaniel\Validate\Validate;

require_login($session);

$keywords = [];
$Thumbdestination = '';

$pathVideos = APP_ROOT . '/public/videos-longos/';
$pathThumbnails = APP_ROOT . '/public/thumbnails/';

$video = [
    'id' => $id,
    'titulo' => '',
    'descricao' => '',
    'video_file' => '',
    'imagem_file' => '',
    'keywords' => '',
    'membro_id' => $session->id,
];

$erros = [
    'warning' => '',
    'titulo' => '',
    'descricao' => '',
    'video_file' => '',
    'imagem_file' => '',
    'keywords' => '',
];

if ($id) {
    $video = $cms->getLongVideo()->get($id);
    $video['imagem_file'] = 'https://img.youtube.com/vi/' . $video['youtube_id'] . '/hqdefault.jpg';
    if (!$video) {
        redirect(DOC_ROOT . 'profile/', ['failure' => 'Vídeo Longo não encontrado']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $videoTemp = $_FILES['video']['tmp_name'] ?? null;
    $thumbTemp = $_FILES['imagem']['tmp_name'] ?? null;

    if ($videoTemp && $_FILES['video']['error'] == 0) {
        $video['video_file'] = create_filename($_FILES['video']['name'], $pathVideos);
        $Videodestination = $pathVideos . $video['video_file'];

        if (!move_uploaded_file($videoTemp, $Videodestination)) {
            die('Erro ao mover o vídeo');
        }
    } elseif ($videoTemp != null) {
        $erros['video_file'] = 'Erro ao carregar o vídeo';
    }

    if ($thumbTemp) {
        if ($thumbTemp && $_FILES['imagem']['error'] == 0) {
            $video['imagem_file'] = create_filename($_FILES['imagem']['name'], $path);
            $Thumbdestination = $pathThumbnails . $video['imagem_file'];

            if (!move_uploaded_file($thumbTemp, $Thumbdestination)) {
                die('Erro ao ao mover a thumbnail');
            }
        } else {
            $erros['imagem_file'] = 'Erro ao carregar a thumbnail';
        }
    }

    $video['titulo'] = $_POST['titulo'];
    $video['descricao'] = $_POST['descricao'];

    $quant_keywords = $_POST['quant_keywords'];

    for ($c = 1; $c <= $quant_keywords; $c++) {
        $keywords[] = preg_replace('/#/', '', $_POST["tag$c"]);
    }

    $video['keywords'] = implode('#', $keywords);
    $video['seo_title'] = create_seo_name($video['titulo']);

    $erros['titulo'] = Validate::isText($video['titulo'], 0 , 256) ? '' : 'A descrição deve ter entre 0 e 2000 caracteres';
    $erros['descricao'] = Validate::isText($video['descricao'], 0 , 4000) ? '' : 'A descrição deve ter entre 0 e 2000 caracteres';

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
        $snippet->setTitle($video['titulo']);
        $snippet->setDescription($video['descricao']);
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

            if ($Thumbdestination) {
                $youtube->thumbnails->set($status['id'], [
                    'data' => file_get_contents($Thumbdestination),
                    'mimeType' => mime_content_type($Thumbdestination),
                    'uploadType' => 'media'
                ]);
                unlink($Thumbdestination);
            }

            $cms->getLongVideo()->create($video['titulo'], $video['descricao'], $video['keywords'], $video['seo_title'], $status['id'], $video['membro_id']);

            redirect(DOC_ROOT . 'profile/' . $video['membro_id'] . '/', ['success' => 'Video Publicado']);
        } else {   
            $client->setScopes([
                'https://www.googleapis.com/auth/youtube',
                'https://www.googleapis.com/auth/youtube.upload',
                'https://www.googleapis.com/auth/youtube.force-ssl'
            ]);
            
            $videoId = $cms->getLongVideo()->get($id)['youtube_id'];
            $videoResponse = $youtube->videos->listVideos('snippet,status', ['id' => $videoId]);
            $items = $videoResponse->getItems();

            if (count($items) === 0) {
                echo "Vídeo não encontrado!";
                exit;
            }

            $cms->getLongVideo()->update($video['titulo'], $video['descricao'], $video['keywords'], $video['seo_title'], $id);

            $youtube_video = $items[0]; // é um Google\Service\YouTube\Video

            // Altera os dados
            $snippet = new Google\Service\YouTube\VideoSnippet();
            $snippet = $youtube_video->getSnippet();
            $snippet->setTitle($video['titulo']);
            $snippet->setDescription($video['descricao']);
            $snippet->setTags($video['keywords']);

            $status = $youtube_video->getStatus();
            $status->setPrivacyStatus("unlisted"); // opcional

            $youtube_video->setSnippet($snippet);
            $youtube_video->setStatus($status);

            // Atualiza o vídeo
            $updateResponse = $youtube->videos->update("snippet,status", $youtube_video);

            if ($Thumbdestination) {
                $youtube->thumbnails->set($status['id'], [
                    'data' => file_get_contents($Thumbdestination),
                    'mimeType' => mime_content_type($Thumbdestination),
                    'uploadType' => 'media'
                ]);
                unlink($Thumbdestination);
            }

            redirect(DOC_ROOT . 'profile/' . $video['membro_id'] . '/', ['success' => 'Video Atualizado']);
        }
    }
}

$data['video'] = $video;
$data['keywords'] = explode('#', $video['keywords']);
$data['count_keywords'] = count($data['keywords']);

echo $twig->render('create-edit-long-video.html', $data);