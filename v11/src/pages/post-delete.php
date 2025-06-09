<?php
require_login($session);

$path = APP_ROOT . 'public/posts/';

if (!$id) {
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['failure' => 'Publicação não encontrada']);
}

$post = $cms->getPost()->get($id);
if (!$post) {
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['failure' => 'Publicação não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getPost()->imageDelete($id, $path);
    $cms->getPost()->delete($id);
    redirect(DOC_ROOT . 'profile/' . $session->id . '/', ['success' => 'Receita apagada com sucesso']);
}

/*echo "<pre>";
var_dump($post);*/

$data['post'] = $post;

echo $twig->render('post-delete.html', $data);
?>
