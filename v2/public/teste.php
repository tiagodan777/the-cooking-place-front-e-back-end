<?php
require_once '../src/bootstrap.php';

/*$article = [];
$article['titulo'] = 'Sushi';
$article['descricao'] = 'Como fazer sushi de forma fácil';
$article['tempo_preparo'] = 45;
$article['unidade_tempo'] = 'min';
$article['numero_pessoas'] = 4;
$article['ingredientes'] = 'Salmão, Abacate, Arroz, Alga Nori';
$article['quantidades'] = '300g, 100g, 400g, 100g';
$article['passos_preparacao'] = 'teste#teste#teste';
$article['keywords'] = 'sushi#japones#facil';
$article['categoria_id'] = 3;
$article['membro_id'] = 1;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $temp = $_FILES['imagem']['tmp_name'] ?? '';
    $article['imagem_file'] = create_filename($_FILES['imagem']['name'], UPLOADS);
    $article['id'] = 1;

    $cms->getArticle()->update($article, $temp, UPLOADS . $article['imagem_file']);
    echo UPLOADS;
    echo "<pre>";
    var_dump($article);
    echo "</pre>";
}*/

$id = 48;
$cms->getArticle()->imageDelete($id, UPLOADS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="teste.php" method="post" enctype="multipart/form-data">
        <input type="file" name="imagem" id="imagem">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>