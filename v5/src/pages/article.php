<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$membro = $cms->getMember()->get(1);

$ingredientes = explode(',', $receita['ingredientes']);
$quantidades = explode(',', $receita['quantidades']);
$passos_preparacao = explode('#', $receita['passos_preparacao']);

$data['receita'] = $receita;
$data['ingredientes'] = $ingredientes;
$data['quantidades'] = $quantidades;
$data['passos_preparacao'] = $passos_preparacao;
$data['membro'] = $membro;

echo $twig->render('article.html', $data);
?>
