<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$video = $cms->getLongVideo()->get($id);
if (!$video) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$data['video'] = $video;

echo $twig->render('video.html', $data);
?>
