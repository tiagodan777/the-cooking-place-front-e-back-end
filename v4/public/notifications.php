<?php
require_once '../src/bootstrap.php';

$link = '';

$notificacoes = $cms->getNotification()->getAll(1);
$membro = $cms->getMember()->get(1);

$data['notificacoes'] = $notificacoes;
$data['membro'] = $membro;

echo $twig->render('notifications.html', $data);
?>
