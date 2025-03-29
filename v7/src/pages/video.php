<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$post = $cms->getLongVideo()->get($id);
if (!$post) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$data['post'] = $post;

echo $twig->render('video.html', $data);
?>
