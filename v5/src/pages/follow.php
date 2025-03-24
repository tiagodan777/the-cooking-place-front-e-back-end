<?php
if (!$id || $cookie->id == 0) {
    redirect('login');
}

$membro = $cms->getMember()->get($id);

echo "<br><br>";
var_dump($cookie->id);
echo "<br><br>";
var_dump($id);
echo "<br><br>";

$followed = $cms->getFollow()->get($cookie->id, $id);
if ($followed) {
    $cms->getFollow()->delete($cookie->id, $id);
} else {
    $cms->getFollow()->create($cookie->id, $id);
}

redirect(DOC_ROOT . 'profile/' . $id . '/' . $membro['seo_name']);
