<?php
is_admin($session->role);

$membros = $cms->getMember()->getAll();

$success = $_GET['success'] ?? null;
$failure = $_GET['failure'] ?? null;

$data['membros'] = $membros;
$data['success'] = $success;
$data['failure'] = $failure;

echo $twig->render('admin/members.html', $data);
?>
