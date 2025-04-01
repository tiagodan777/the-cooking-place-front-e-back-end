<?php
is_admin($cookie->role);

$categorias = $cms->getCategory()->count();

$conteudo = $cms->getContent()->count();

$membros = $cms->getMember()->count();

$data['categorias'] = $categorias;
$data['conteudo'] = $conteudo;
$data['membros'] = $membros;

echo $twig->render('admin/index.html', $data);
?>
