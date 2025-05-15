<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$post = $cms->getPost()->get($id);
if (!$post) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$cms->getContent()->createView($id, $session->id);

$emoji_cod = mt_rand(1, 98);

$getMoreContents = require_once 'more-contents.php';
$conteudos = $getMoreContents($cms, $parts, $id);

$data['post'] = $post;
$data['emoji_cod'] = $emoji_cod;
$data['conteudos'] = is_array($conteudos) ? $conteudos : [$conteudos];

echo $twig->render('post.html', $data);
?>
