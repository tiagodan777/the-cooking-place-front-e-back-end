<?php
use TiagoDaniel\Validate\Validate;

require_once '../src/bootstrap.php';

require_login($cookie);

$membro = $cms->getMember()->get($cms->getCookie()->id);

$data['membro'] = $membro;

echo $twig->render('edit-profile.html', $data);