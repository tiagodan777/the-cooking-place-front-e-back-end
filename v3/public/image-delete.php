<?php
require_once '../src/bootstrap.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect('articles.php', ['failure' => 'Receita não encontrada']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect('articles.php', ['failure' => 'Receita não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    redirect('create-edit-article.php', ['success' => 'Imagem apagar com êxito', 'id' => $id]);   
}

$membro = $cms->getMember()->get(1);

$data['receita'] = $receita;
$data['membro'] = $membro;

echo $twig->render('image-delete.html', $data);
?>
