<?php
$data = [];

$receitas = $cms->getArticle()->getAll();
$opinioes = $cms->getOpinion()->getAll();

$data['receitas'] = $receitas;
$data['count'] = 0;
$data['opinioes'] = $opinioes;

/*echo "<pre>";
var_dump($receitas);
echo "</pre>";*/

echo $twig->render('index.html', $data);
/*echo "<pre>";
var_dump($data['articles']);
echo "</pre>";*/
?>
