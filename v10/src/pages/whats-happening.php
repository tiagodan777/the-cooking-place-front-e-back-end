<?php
$quiks = $cms->getQuik()->getAll();
$i = 1;

$data['quiks'] = $quiks;
$data['i'] = $i;

echo $twig->render('whats-happening.html', $data);
?>


