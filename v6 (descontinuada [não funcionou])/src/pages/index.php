<?php
$data = [];

$receitas = $cms->getContent()->get();

//$novas_datas = postado_ha_x_horas($receitas);

$data['receitas'] = $receitas;
$data['count'] = 0;
//$data['novas_datas'] = $novas_datas;

echo "<pre>";
var_dump($receitas);
echo "</pre>";

echo $twig->render('index.html', $data);
?>
