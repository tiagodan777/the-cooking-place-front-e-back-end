<?php 
require_once '../../src/bootstrap.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect('categories.php', ['failure' => 'Categoria não encontrada']);
}

$categoria = $cms->getCategory()->get($id);
if (!$categoria) {
    redirect('categories.php', ['failure' => 'Categoria não encontrada']);
}

$membro = $cms->getMember()->get(1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $apagada = $cms->getCategory()->delete($id);
    if ($apagada) {
        redirect('categories.php', ['success' => 'Categoria apagada']);
    } else {
        redirect('categories.php', ['failure' => 'Existem artigos que pertencem a esta categoria que têm de ser apagados ou colocados noutra categoria']);
    }
}

$data['categoria'] = $categoria;
$data['membro'] = $membro;

echo $twig->render('admin/category-delete.html', $data);
?>
