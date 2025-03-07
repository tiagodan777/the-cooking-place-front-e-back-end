<?php
require_once '../../src/bootstrap.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect('articles.php', ['failure' => 'Receita não encontrada']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect('articles.php', ['failure' => 'Receita não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    redirect('create-edit-article.php', ['success' => 'Imagem apagar com êxito', 'id' => $id]);   

}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cooking Place</title>
    <link rel="shortcut icon" href="imagens/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/desktop.css" media="screen and (min-width: 900px)">
    <link rel="stylesheet" href="../estilos/admin/category-detele.css">
    <link rel="stylesheet" href="../estilos/admin/image-delete.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <header id="cabecalho-principal">
        <h1>
            <a href="../pagina-principal.html">
                <picture>
                    <source media="(max-width: 600px)" srcset="../imagens/logos/logo-pp.png">
                    <img src="../imagens/logos/logo-p.png" alt="Logo do The Cooking Place">
                </picture>
            </a>
        </h1>
        <form action="../search.php" method="get">
            <input type="search" name="search" id="search" placeholder="Pesquisa">
            <input type="submit" value="Pesquisar" class="escondido">
        </form>
        <div>
            <a href="../create-edit-article.html"><span class="material-symbols-outlined">add_box</span></a>
            <a href="../profile.html"><span class="material-symbols-outlined">account_circle</span></a>
        </div>
    </header>
    <br>
    <main>
        <section id="apagar">
            <h2>Apagar Imagem</h2>
            <section id="dados">
                <p>Confirma para apagar a imagem:</p>
                <img src="../imagens/comida/<?= $receita['imagem_file'] ?>" alt="">
            </section>
            <section id="opcoes">
                <form action="image-delete.php?id=<?= $id ?>" method="post">
                    <a href="create-edit-article.php?id=<?= $id ?>">Cancelar</a>
                    <input type="submit" value="Confirmar">
                </form>
            </section>
        </section>
    </main>
    <footer>
        <a href="pagina-principal.html"><span class="material-symbols-outlined aparece-desktop">home</span> <span class="descricao-icone">Página Principal</span></a>
        <a href="notifications.html"><span class="material-symbols-outlined aparece-desktop">favorite</span> <span class="descricao-icone nao-destaque">Notificações</span></a>
        <a href="all-messages.html"><span class="material-symbols-outlined">send</span> <span class="descricao-icone nao-destaque">Mensagens</span></a>
        <a href="whats-happening.html"><span class="material-symbols-outlined aparece-desktop">star</span> <span class="descricao-icone nao-destaque">O que está a acontecer?</span></a>
        <a href="profile.html"><span class="material-symbols-outlined aparece-desktop">account_circle</span> <span class="descricao-icone nao-destaque">Perfil</span></a>
        <a href="create-edit-article.html"><span class="material-symbols-outlined aparece-mobile">add_box</span></a>
        <a href="#"><span class="material-symbols-outlined aparece-mobile">search</span></a>
    </footer>
</body>
</html>