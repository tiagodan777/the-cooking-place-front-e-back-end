<?php
require_once '../../src/bootstrap.php';
is_admin($cookie->role);

$categorias = $cms->getCategory()->getAll();

$membro = $cms->getMember()->get(1);

$success = $_GET['success'] ?? null;
$failure = $_GET['failure'] ?? null;

$data['categorias'] = $categorias;
$data['membro'] = $membro;
$data['success'] = $success;
$data['failure'] = $failure;

echo $twig->render('admin/categories.html', $data);
?>
