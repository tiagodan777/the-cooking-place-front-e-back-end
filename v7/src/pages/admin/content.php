<?php
is_admin($cookie->role);

$conteudos = $cms->getContent()->get();

$success = $_GET['success'] ?? null;
$failure = $_GET['failure'] ?? null;

$data['conteudos'] = $conteudos;
$data['success'] = $success;
$data['failure'] = $failure;

echo $twig->render('admin/content.html', $data);
?>
