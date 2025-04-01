<?php
is_admin($cookie->role);

$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect(DOC_ROOT . 'articles/', ['failure' => 'Receita não encontrada']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect(DOC_ROOT . 'articles/', ['failure' => 'Receita não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    redirect(DOC_ROOT . 'create-edit-article/', ['success' => 'Imagem apagar com êxito', 'id' => $id]);   
}

$membro = $cms->getMember()->get(1);

$data['receita'] = $receita;
$data['membro'] = $membro;

echo $twig->render('admin/image-delete.html', $data);
?>
