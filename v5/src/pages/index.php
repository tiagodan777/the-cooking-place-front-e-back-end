<?php
$data = [];

$receitas = $cms->getArticle()->getAll();

$data['receitas'] = $receitas;
$data['count'] = 0;

/*echo "<pre>";
var_dump($receitas);
echo "</pre>";*/

echo $twig->render('index.html', $data);
/*echo "<pre>";
var_dump($data['articles']);
echo "</pre>";*/
?>
