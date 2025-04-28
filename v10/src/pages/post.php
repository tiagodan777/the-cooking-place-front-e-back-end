<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$post = $cms->getPost()->get($id);
if (!$post) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$data['post'] = $post;

echo $twig->render('post.html', $data);
?>
