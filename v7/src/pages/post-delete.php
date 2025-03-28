<?php
require_login($cookie);

$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect(DOC_ROOT . 'profile/' . $cookie->id . '/', ['failure' => 'Receita não encontrada']);
}

$post = $cms->getPost()->get($id);
if (!$post) {
    redirect(DOC_ROOT . 'profile/' . $cookie->id . '/', ['failure' => 'Receita não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    $cms->getArticle()->delete($id);
    redirect(DOC_ROOT . 'profile/' . $cookie->id . '/', ['success' => 'Receita apagada com sucesso']);
}

$data['post'] = $post;

echo $twig->render('post-delete.html', $data);
?>
