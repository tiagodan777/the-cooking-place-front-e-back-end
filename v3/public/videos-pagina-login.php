<?php
require_once '../src/bootstrap.php';

$membro = $cms->getMember()->get(1);

$data['member'] = $membro;

$twig->render('videos-pagina-login.html', $data);