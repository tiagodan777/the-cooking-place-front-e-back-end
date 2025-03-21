<?php
$quiks = $cms->getQuik()->getAll();
$i = 1;

$membro = $cms->getMember()->get(1);

$data['quiks'] = $quiks;
$data['i'] = $i;
$data['membro'] = $membro;

echo $twig->render('whats-happening.html', $data);
?>
