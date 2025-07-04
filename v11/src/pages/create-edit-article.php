<?php
use TiagoDaniel\Validate\Validate;

require_login($session);

$unidades_tempo = ['min', 'hr'];

$temp = $_FILES['imagem']['tmp_name'] ?? '';
$erro_com_a_imagem = $_FILES['imagem']['error'] ?? '';
$destination = '';
$ingredientes = [];
$quantidades = [];
$passos_preparacao = [];
$keywords = [];
$pathVideos = APP_ROOT . '/public/videos-longos/';

$receita = [
    'id' => $id,
    'titulo' => '',
    'descricao' => '',
    'tempo_preparo' => '',
    'unidade_tempo' => '',
    'numero_pessoas' => '',
    'ingredientes' => '',
    'quantidades' => '',
    'passos_preparacao' => '',
    'keywords' => '',
    'imagem_file' => '',
    'youtube_id' => '',
    'categoria_id' => 0,
    'membro_id' => 0,
];
$erros = [
    'warning' => '',
    'titulo' => '',
    'descricao' => '',
    'tempo_preparo' => '',
    'unidade_tempo' => '',
    'numero_pessoas' => '',
    'ingredientes' => '',
    'quantidades' => '',
    'passos_preparacao' => '',
    'keywords' => '',
    'imagem_file' => '',
    'youtube_id' => '',
    'categoria_id' => '',
    'membro_id' => '',
];

if ($id) {
    $receita = $cms->getArticle()->get($id);
    if (!$receita) {
        redirect(DOC_ROOT . 'profile/' . $id, ['failure' => 'Receita não encontrada']);
    }
}

$saved_image = $receita['imagem_file'] ? true : false;

$categorias = $cms->getCategory()->getAll();

/*$autores = $cms->getMember()->getAll();*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $erros['imagem_file'] = ($temp === '' && $erro_com_a_imagem === 1) ? 'Ficheiro demasiado grande' : '';

    if ($temp && $_FILES['imagem']['error'] === 0) {
        $erros['imagem_file'] .= in_array(mime_content_type($temp), MEDIA_TYPES) ? '' : 'Tipo de ficherio não permitido';
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $erros['imagem_file'] .= in_array($ext, FILE_EXTENSIONS) ? '' : 'Tipo de extensão não permitida';
        $erros['imagem_file'] .= ($_FILES['imagem']['size'] <= MAX_SIZE) ? '' : 'Ficherio demasiado grande';

        if ($erros['imagem_file'] === '') {
            $receita['imagem_file'] = create_filename($_FILES['imagem']['name'], UPLOADS);
            $destination = UPLOADS . $receita['imagem_file'];
            $destination_cropped_500 = UPLOADS_CROPPED_500 . $receita['imagem_file'];
            $destination_cropped_600 = UPLOADS_CROPPED_600 . $receita['imagem_file'];
            $destination_cropped_700 = UPLOADS_CROPPED_700 . $receita['imagem_file'];

        }
    }

    $receita['titulo'] = $_POST['titulo'];
    $receita['descricao'] = $_POST['descricao'];
    $receita['tempo_preparo'] = $_POST['tempo_preparo'];
    $receita['unidade_tempo'] = $_POST['unidade_tempo'];
    $receita['numero_pessoas'] = $_POST['numero_pessoas'];

    $quant_ingredientes = $_POST['quant_ingredientes'];
    $quant_quantidades = $_POST['quant_quantidades'];
    $quant_passos_preparacao = $_POST['quant_passos_preparacao'];
    $quant_keywords = $_POST['quant_keywords'];

    for ($c = 1; $c <= $quant_ingredientes; $c++) {
        $ingredientes[] = $_POST["ingredientes$c"];
    }

    for ($c = 1; $c <= $quant_quantidades; $c++) {
        $quantidades[] = $_POST["quantidades$c"];
    }

    for ($c = 1; $c <= $quant_passos_preparacao; $c++) {
        $passos_preparacao[] .= $_POST["passo$c"];
    }

    for ($c = 1; $c <= $quant_keywords; $c++) {
        $keywords[] = preg_replace('/#/', '', $_POST["tag$c"]);
    }

    $receita['ingredientes'] = implode(',', $ingredientes);
    $receita['quantidades'] = implode(',', $quantidades);
    $receita['passos_preparacao'] = implode('#', $passos_preparacao);
    $receita['keywords'] = implode('#', $keywords);
    $receita['membro_id'] = $_POST['membro_id'];
    $receita['categoria_id'] = $_POST['categoria_id'];
    $receita['seo_title'] = create_seo_name($receita['titulo']);

    $purifier = new HTMLPurifier();
    $purifier->config->set('HTML.Allowed', 'p,br,strong,em,a[href],img[src|alt]');
    $receita['passos_preparacao'] = $purifier->purify($receita['passos_preparacao']);

    /*foreach ($autores as $autor) {
        if ($receita['membro_id'] == $autor['id']) {
            $autor = $autor['nome'];
        }
    }*/

    $erros['titulo'] = Validate::isText($receita['titulo'], 1, 64) ? '' : 'O título deve ter entre 1 e 64 caracteres';
    $erros['descricao'] = Validate::isText($receita['descricao'], 1, 256) ? '' : 'A descrição deve ter entre 1 e 256 caracteres';
    $erros['tempo_preparo'] = Validate::isNumber($receita['tempo_preparo'], 0, 360) ? '' : 'O tempo de preparo deve ser entre 1 e 360';
    $erros['unidade_tempo'] = in_array($receita['unidade_tempo'], $unidades_tempo) ? '' : 'A unidade de tempo deve ser minutos ou horas';
    $erros['numero_pessoas'] = Validate::isNumber($receita['numero_pessoas'], 0, 16) ? '' : 'O número de pessoas deve ser entre 1 e 16';
    $erros['ingredientes'] = Validate::isText($receita['ingredientes'], 0, 1024) ? '' : 'A soma de todos os caracteres de todos os ingredientes não deve ser maior que 1024';
    $erros['quantidades'] = Validate::isText($receita['quantidades'], 0, 1024) ? '' : 'A soma de todos os caracteres de todas as quantiades não deve ser maior que 1024';
    $erros['passos_preparacao'] = Validate::isText($receita['passos_preparacao'], 0, 65244) ? '' : 'A soma de todos oscaracteres de todos os passos de preparação não deve ser maior que 65244';
    $erros['keywords'] = Validate::isText($receita['keywords'], 0, 1024) ? '' : 'A soma de todos os caracteres de todas as keywords não deve ser maior que 1024';
    $erros['categoria_id'] = Validate::isCategoryId($receita['categoria_id'], $categorias) ? '' : 'A categoria selectionada não é válida';
    /*$erros['membro_id'] = Validate::isMemberId($receita['membro_id'], $autores);*/

    $invalid = implode($erros);

    if ($invalid) {
        $erros['warning'] = 'Por favor corrige os error seguintes';
    } else {
        $arguments = $receita;
        if ($id) {
            unset($arguments['data']);
            unset($arguments['nome']);
            unset($arguments['autor']);
            unset($arguments['picture']);
            unset($arguments['id_membro']);
            unset($arguments['seo_member']);
            unset($arguments['likes']);
            unset($arguments['opinioes']);
            unset($arguments['youtube_id']);
            unset($arguments['quik_file']);
            echo "<pre>";
            var_dump($arguments);
            echo "</pre>";
            $guardada = $cms->getArticle()->update($arguments, $temp, $destination, $destination_cropped_500, $destination_cropped_600, $destination_cropped_700);
        } else {
            unset($arguments['id']);
            unset($arguments['data']);
            unset($arguments['nome']);
            unset($arguments['autor']);
            unset($arguments['picture']);
            unset($arguments['id_membro']);
            unset($arguments['seo_member']);
            unset($arguments['likes']);
            unset($arguments['opinioes']);
            unset($arguments['youtube_id']);
            echo "<pre>";
            var_dump($arguments);
            echo "</pre>";
            $guardada = $cms->getArticle()->create($arguments, $temp, $destination, $destination_cropped_500, $destination_cropped_600, $destination_cropped_700);
        }
        if ($_FILES['video']['tmp_name']) {
            $videoTemp = $_FILES['video']['tmp_name'] ?? null;
            $thumbTemp = $_FILES['imagem']['tmp_name'] ?? null;

            if ($videoTemp && $_FILES['video']['error'] == 0) {
                $receita['youtube_id'] = create_filename($_FILES['video']['name'], $pathVideos);
                $Videodestination = $pathVideos . $receita['youtube_id'];

                if (!move_uploaded_file($videoTemp, $Videodestination)) {
                    die('Erro ao mover o vídeo');
                }
            } elseif ($videoTemp != null) {
                $erros['youtube_id'] = 'Erro ao carregar o vídeo';
            }
            $invalid = implode($erros);
            if ($invalid) {
                $erros['warning'] = 'Por favor corrige os erros';
            } else {
                $client = new Google\Client();
                $client->setAuthConfig('../client_secret.json');
                $client->setRedirectUri('http://localhost:8888/the-cooking-place-front-e-back-end/v11/public/callback/'); 
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
                $snippet->setTitle($receita['titulo']);
                $snippet->setDescription($receita['descricao']);
                if (!empty($receita['keywords'])) {
                    $tags = explode('#', $receita['keywords']);
                    $snippet->setTags($tags);
                }
                $snippet->setCategoryId('26');

                $status = new Google\Service\YouTube\VideoStatus();
                $status->privacyStatus = 'unlisted';
                $status->setSelfDeclaredMadeForKids = false;
                $status->madeForKids = false;

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
                
                unlink($Videodestination);

                $youtube_id = $status['id'];

                $id_receita = $cms->getArticle()->getLastInsertedIdBySeoTitleAndMember($receita['seo_title'], $receita['membro_id']);
                $receita['id'] = $id_receita['id'];

                $arguments = [
                    'youtube_id' => $youtube_id,
                    'id' => $receita['id'],
                ];
                $cms->getArticle()->addYouTubeId($arguments);
            }
        $receita['imagem_file'] = $saved_image ? $receita['imagem_file'] : '';
        redirect(DOC_ROOT . 'profile/' . $receita['membro_id'] . '/', ['success' => 'Artigo guardado']);  
        }
    }
}

$data['receita'] = $receita;
$data['erros'] = $erros;
$data['categorias'] = $categorias;
/*$data['autores'] = $autores;
$data['autor'] = $autor;*/
$data['ingredientes'] = explode(',', $receita['ingredientes']);
$data['count_ingredientes'] = count($data['ingredientes']);
$data['quantidades'] = explode(',', $receita['quantidades']);
$data['passos_preparacao'] = explode('#', $receita['passos_preparacao']);
$data['count_passos_preparacao'] = count($data['passos_preparacao']);
$data['keywords'] = explode('#', $receita['keywords']);
$data['count_keywords'] = count($data['keywords']);


echo $twig->render('create-edit-article.html', $data);
?>