<?php
require_once '../src/bootstrap.php';

$term = filter_input(INPUT_GET, 'search');
$show = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 15;
$from = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0;

$count = 0;
$receitas = [];
$arguments = [];

if ($term) {
    $count = $cms->getArticle()->searchCount($term);

    if ($count > 0) {
        $receitas = $cms->getArticle()->search($term, $show, $from);
    }
}

if ($count > $show) {
    $total_pages = ceil($count / $show);
    $current_page = ceil($from / $show) + 1;
}
?>
