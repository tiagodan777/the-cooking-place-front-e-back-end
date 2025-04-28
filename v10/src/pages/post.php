<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$post = $cms->getPost()->get($id);
if (!$post) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$emoji_cod = mt_rand(1, 98);

$data['post'] = $post;
$data['emoji_cod'] = $emoji_cod;

echo $twig->render('post.html', $data);
?>
