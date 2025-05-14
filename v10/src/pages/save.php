<?php
require_login($session);

try {
    $file = $_GET['file'] ?? null;
$tipo_conteudo = $_GET['tipo_conteudo'] ?? null;

if (!$id || $session->id == 0 || $file == null) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$saved = $cms->getSaved()->get([$id, $session->id]);
if ($saved) {
    $cms->getSaved()->delete([$id, $session->id]);
} else {
    $cms->getSaved()->create([$id, $session->id, $file, $tipo_conteudo]);
}

redirect(DOC_ROOT);
} catch (Exception $e) {
    var_dump($e);
}
