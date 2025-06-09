<?php
$tokenLogin = $_GET['loginToken'] ?? '';

if ($session->id != 0 && empty($tokenLogin)) {
    $tokenLogin = $cms->getToken()->create($session->id, 'login');
}
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$video = $cms->getLongVideo()->get($id);
if (!$video) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$cms->getContent()->createView($id, $session->id);

$emoji_cod = mt_rand(1, 98);

$getMoreContents = require_once 'more-contents.php';
$conteudos = $getMoreContents($cms, $parts, $id);

$data['video'] = $video;
$data['emoji_cod'] = $emoji_cod;
$data['conteudos'] = $conteudos;
$data['tokenLogin'] = $tokenLogin;

echo $twig->render('video.html', $data);
?>
