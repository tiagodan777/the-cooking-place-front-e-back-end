<?php
require_login($cookie);

$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect('articles', ['failure' => 'Receita não encontrada']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect('articles', ['failure' => 'Receita não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    redirect(DOC_ROOT . 'create-edit-article/' . $id . '/', ['success' => 'Imagem apagada com êxito']);   
}

$membro = $cms->getMember()->get(1);

$data['receita'] = $receita;
$data['membro'] = $membro;

echo $twig->render('image-delete.html', $data);
?>
