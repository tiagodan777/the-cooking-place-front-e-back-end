<?php
$file = $_GET['file'] ?? null;
$tipo_conteudo = $_GET['tipo_conteudo'] ?? null;

if (!$id || $cookie->id == 0 || $file == null) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$saved = $cms->getSaved()->get([$id, $cookie->id]);
if ($saved) {
    $cms->getSaved()->delete([$id, $cookie->id]);
} else {
    $cms->getSaved()->create([$id, $cookie->id, $file, $tipo_conteudo]);
}

redirect(DOC_ROOT . 'index');