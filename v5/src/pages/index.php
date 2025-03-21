<?php
$data = [];

$data['receitas'] = $cms->getArticle()->getAll();
$data['membro'] = $cms->getMember()->get(1);
$data['count'] = 0;

/*echo "<pre>";
foreach ($data['articles'] as $article) {
    //var_dump($article['data']);
    $article['data'] = '';
    echo $article['data'];
}
echo "</pre>";*/

echo $twig->render('index.html', $data);
/*echo "<pre>";
var_dump($data['articles']);
echo "</pre>";*/
?>
