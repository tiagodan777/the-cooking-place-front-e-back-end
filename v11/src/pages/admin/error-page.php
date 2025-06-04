<?php
is_admin($session->role);

$membro = $cms->getMember()->get(1);

$data['membro'] = $membro;

echo $twig->render('admin/error-page.html', $data);
