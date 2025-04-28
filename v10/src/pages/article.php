<?php
if (!$id) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    include APP_ROOT . '/src/pages/error-page.php';
}

$ingredientes = explode(',', $receita['ingredientes']);
$quantidades = explode(',', $receita['quantidades']);
$passos_preparacao = explode('#', $receita['passos_preparacao']);
$emoji_cod = mt_rand(1, 98);


if (mb_strtolower($parts[2]) != mb_strtolower($receita['seo_title'])) {
    redirect(DOC_ROOT . 'article/' . $id . '/' . $receita['seo_title'], [], 301);
}

$data['receita'] = $receita;
$data['ingredientes'] = $ingredientes;
$data['quantidades'] = $quantidades;
$data['passos_preparacao'] = $passos_preparacao;
$data['emoji_cod'] = $emoji_cod;

echo $twig->render('article.html', $data);
?>


