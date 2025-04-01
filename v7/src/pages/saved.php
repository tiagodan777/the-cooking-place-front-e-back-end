<?php
$show = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 15;
$from = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0;

$count = 0;
$total_pages = 0;
$current_page = 0;
$conteudos = [];
$arguments = [];


$count = $cms->getSaved()->count($cookie->id);

if ($count > 0) {
    $conteudos = $cms->getSaved()->getFull($cookie->id);
}

if ($count > $show) {
    $total_pages = ceil($count / $show);
    $current_page = ceil($from / $show) + 1;
}

$data['count'] = $count;
$data['show'] = $show;
$data['conteudos'] = $conteudos;
$data['total_pages'] = $total_pages;
$data['current_page'] = $current_page;

echo $twig->render('saved.html', $data);
?>
