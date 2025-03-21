<?php
$membro = $cms->getMember()->get(1);

$data['membro'] = $membro;

echo $twig->render('error-page.html', $data);
exit;
?>