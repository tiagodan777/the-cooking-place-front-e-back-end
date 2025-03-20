<?php
require_once '../src/bootstrap.php';

require_login($cookie);

$membro = $cms->getMember()->get(1);

$data['membro'] = $membro;

echo $twig->render('all-messages.html', $data);
?>
