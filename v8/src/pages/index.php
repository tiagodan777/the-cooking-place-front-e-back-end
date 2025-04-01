<?php
$data = [];
$emojis = [];

$conteudos = $cms->getContent()->get();
$num_emojis = $cms->getContent()->count();
$emojis_cod = array_map(fn() => mt_rand(1, 99), range(1, $num_emojis));

//$novas_datas = postado_ha_x_horas($receitas);

$data['conteudos'] = $conteudos;
$data['emojis_cod'] = $emojis_cod;
$data['count'] = 0;
//$data['novas_datas'] = $novas_datas;

echo $twig->render('index.html', $data);
?>
