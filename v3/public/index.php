<?php
require_once '../src/bootstrap.php';

$data = [];

$data['articles'] = $cms->getArticle()->getAll();
$data['membro'] = $cms->getMember()->get(1);
$data['count'] = 0;

echo $twig->render('index.html', $data);
?>
