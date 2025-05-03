<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$video = $cms->getLongVideo()->get($id);
if (!$video) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$emoji_cod = mt_rand(1, 98);

$getMoreContents = require_once 'more-contents.php';
$conteudos = $getMoreContents($cms, $parts, $id);

$data['video'] = $video;
$data['emoji_cod'] = $emoji_cod;
$data['conteudos'] = $conteudos;

echo $twig->render('video.html', $data);
?>
