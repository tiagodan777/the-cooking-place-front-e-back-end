<?php
if (!$id || $cookie->id == 0) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$liked = $cms->getLike()->get([$id, $cookie->id]);
if ($liked) {
    $cms->getLike()->delete([$id, $cookie->id]);
} else {
    $cms->getLike()->create([$id, $cookie->id]);
}

redirect(DOC_ROOT . 'index');