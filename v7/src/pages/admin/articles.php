<?php
is_admin($cookie->role);

$receitas = $cms->getArticle()->getAll();

$membro = $cms->getMember()->get(1);

$success = $_GET['success'] ?? null;
$failure = $_GET['failure'] ?? null;

$data['receitas'] = $receitas;
$data['membro'] = $membro;
$data['success'] = $success;
$data['failure'] = $failure;

echo $twig->render('admin/articles.html', $data);
?>
