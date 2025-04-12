<?php
use TiagoDaniel\Validate\Validate;

require_login($session);

$keywords = [];

$pathVideos = APP_ROOT . '/public/videos-longos/';
$pathThumbnails = APP_ROOT . 'public/thumbnails';

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
    $video_longo = $cms->getLongVideo()->get($id);
    if (!$video_longo) {
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
    } else {
        $erros['video_file'] = 'Erro ao carregar o vídeo';
    }

    if ($thumbTemp) {
        if ($thumbTemp && $_FILES['imagem']['error'] == 0) {
            $video['imagem_file'] = create_filename($_FILES['imagem']['name'], $path);
            $Thumbdestination = $path . $video['imagem_file'];

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

    $erros['titulo'] = Validate::isText($video['titulo'], 0 , 256) ? '' : 'A descrição deve ter entre 0 e 2000 caracteres';
    $erros['descricao'] = Validate::isText($video['descricao'], 0 , 4000) ? '' : 'A descrição deve ter entre 0 e 2000 caracteres';

    $invalid = implode($erros);
    if ($invalid) {
        $erros['warning'] = 'Por favor corrige os erros';
    } else {
        if (!$id) {
            /*unset($post['id']);
            $cms->getPost()->create($post, $temp, $destination);
            redirect(DOC_ROOT . 'profile/'  . $session->id . $session->seo_name, ['success' => 'Publicado com sucesso']);*/

            $client = new Google\Client();
            $client->setAuthConfig('../client_secret.json');
            $client->setRedirectUri('http://localhost:8888/the-cooking-place-front-e-back-end/v9/public/callback/'); 
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
                echo "<pre>";
                var_dump($newToken);
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

            $youtube_video = new Google\Service\YouTube\Video();
            $youtube_video->setSnippet($snippet);
            $youtube_video->setStatus($status);

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
            
            unlink($videoPath);
            redirect(DOC_ROOT);
        } /*else {
            unset($post['data']);
            unset($post['membro_id']);
            unset($post['autor']);
            unset($post['picture']);
            unset($post['likes']);
            unset($post['opinioes']);
            unset($post['imagem_file']);

            $cms->getPost()->update($post);
            redirect(DOC_ROOT . 'profile/' . $session->id . $session->seo_name , ['success' => 'Publicação editada com sucesso']);
        }*/
    }
}

var_dump($erros);

$data['video'] = $video;
$data['keywords'] = 
$data['count_keywords'] = 1;

echo $twig->render('create-edit-long-video.html', $data);