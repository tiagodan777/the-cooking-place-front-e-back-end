<?php
require_once '../src/bootstrap.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    include 'error-page.php';
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    include 'error-page.php';
}

$ingredientes = explode(',', $receita['ingredientes']);
$quantidades = explode(',', $receita['quantidades']);
$passos_preparacao = explode('#', $receita['passos_preparacao']);

$data['receita'] = $receita;
$data['ingredientes'] = $ingredientes;
$data['quantidades'] = $quantidades;
$data['passos_preparacao'] = $passos_preparacao;

echo $twig->render('article.html', $data);
?>
