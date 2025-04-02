<?php
require_login($session);

if (!$id || $session->id == 0) {
    redirect(DOC_ROOT . 'login');
}

$membro = $cms->getMember()->get($id);

$followed = $cms->getFollow()->get($session->id, $id);
if ($followed) {
    $cms->getFollow()->delete($session->id, $id);
} else {
    $cms->getFollow()->create($session->id, $id);
}

redirect(DOC_ROOT . 'profile/' . $id . '/' . $membro['seo_name']);
