<?php
require_login($session);

$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['failure' => 'Receita não encontrada']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['failure' => 'Receita não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    $cms->getArticle()->delete($id);
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['success' => 'Receita apagada com sucesso']);
}

$data['receita'] = $receita;

echo $twig->render('article-delete.html', $data);
?>
