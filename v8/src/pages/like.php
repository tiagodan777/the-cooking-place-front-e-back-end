<?php
if (!$id || $session->id == 0) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$liked = $cms->getLike()->get([$id, $session->id]);
if ($liked) {
    $cms->getLike()->delete([$id, $session->id]);
} else {
    $cms->getLike()->create([$id, $session->id]);
}

redirect(DOC_ROOT . 'index');