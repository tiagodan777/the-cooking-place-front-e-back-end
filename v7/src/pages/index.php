<?php
$data = [];

$receitas = $cms->getArticle()->getAll();

//$novas_datas = postado_ha_x_horas($receitas);

$data['receitas'] = $receitas;
$data['count'] = 0;
//$data['novas_datas'] = $novas_datas;

echo $twig->render('index.html', $data);
?>
