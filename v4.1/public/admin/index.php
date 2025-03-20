<?php
require_once '../../src/bootstrap.php';
is_admin($cookie->role);

$categorias = $cms->getCategory()->count();

$receitas = $cms->getArticle()->count();

$membros = $cms->getMember()->count();

$membro = $cms->getMember()->get(1);

$data['categorias'] = $categorias;
$data['receitas'] = $receitas;
$data['membros'] = $membros;
$data['membro'] = $membro;

echo $twig->render('admin/index.html', $data);
?>
