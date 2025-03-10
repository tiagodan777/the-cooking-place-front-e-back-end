<?php
require_once '../src/bootstrap.php';

$membro = $cms->getMember()->get(1);

$data['membro'] = $membro;

echo $twig->render('register.html', $data);