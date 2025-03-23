<?php
require_login($cookie);

$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect(DOC_ROOT . 'profile/' . $cookie->id . '/', ['failure' => 'Receita não encontrada']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect(DOC_ROOT . 'profile/' . $cookie->id . '/', ['failure' => 'Receita não encontrada']);
}

$membro = $cms->getMember()->get(1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    $cms->getArticle()->delete($id);
    redirect(DOC_ROOT . 'profile/' . $cookie->id . '/', ['success' => 'Receita apagada com sucesso']);
}

$data['receita'] = $receita;
$data['membro'] = $membro;

echo $twig->render('article-delete.html', $data);
?>
