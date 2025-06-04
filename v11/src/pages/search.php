<?php
$term = filter_input(INPUT_GET, 'search');
$show = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 10;
$from = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0;

$count = 0;
$total_pages = 0;
$current_page = 0;
$conteudos = [];
$arguments = [];

if ($term) {
    $count = $cms->getContent()->searchCount($term);

    if ($count > 0) {
        $conteudos = $cms->getContent()->search($term, $show, $from);
    } else {
        redirect(DOC_ROOT . 'error-page', ['message' => 'Não foram encontrados resultados']);
    }
}

if ($count > $show) {
    $total_pages = ceil($count / $show);
    $current_page = ceil($from / $show) + 1;
}

$data['term'] = $term;
$data['count'] = $count;
$data['show'] = $show;
if ($term) {
    $data['conteudos'] = $conteudos[0];
    $data['membros'] = $conteudos[1];
}
$data['total_pages'] = $total_pages;
$data['current_page'] = $current_page;

echo $twig->render('search.html', $data);
?>

