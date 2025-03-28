<?php 
is_admin($cookie->role);

if (!$id) {
    redirect(DOC_ROOT . 'admin/categories/', ['failure' => 'Categoria não encontrada']);
}

$categoria = $cms->getCategory()->get($id);
if (!$categoria) {
    redirect(DOC_ROOT . 'admin/categories/', ['failure' => 'Categoria não encontrada']);
}

$membro = $cms->getMember()->get(1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $apagada = $cms->getCategory()->delete($id);
    if ($apagada) {
        redirect(DOC_ROOT . 'admin/categories/', ['success' => 'Categoria apagada']);
    } else {
        redirect(DOC_ROOT . 'admin/categories/', ['failure' => 'Existem artigos que pertencem a esta categoria que têm de ser apagados ou colocados noutra categoria']);
    }
}

$data['categoria'] = $categoria;
$data['membro'] = $membro;

echo $twig->render('admin/category-delete.html', $data);
?>
