<?php
require_login($session);

$link = '';

// $notificacoes = $cms->getNotification()->getAll(1);

/*$data['notificacoes'] = $notificacoes;
$data['membro'] = $membro;*/

echo $twig->render('notifications.html');
?>
