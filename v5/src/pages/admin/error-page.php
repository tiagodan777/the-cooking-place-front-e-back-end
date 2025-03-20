<?php
require_once '../../src/bootstrap.php';
is_admin($cookie->role);

$membro = $cms->getMember()->get(1);

$data['membro'] = $membro;

echo $twig->render('admin/error-page.html', $data);
