<?php
$quiks = $cms->getQuik()->getAll();
$i = 1;

$num_emojis = $cms->getQuik()->count();
$emojis_cod = array_map(fn() => mt_rand(1, 98), range(1, $num_emojis));

$cms->getContent()->createView($id, $session->id);

$data['quiks'] = $quiks;
$data['count'] = 1;
$data['emojis_cod'] = $emojis_cod;
$data['i'] = $i;

echo $twig->render('whats-happening.html', $data);
?>


