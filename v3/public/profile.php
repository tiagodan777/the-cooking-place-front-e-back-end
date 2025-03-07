<?php
require_once '../src/bootstrap.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    include 'error-page.php';
}

$membro = $cms->getMember()->get($id);
if (!$membro) {
    include 'error-page.php';
}

$receitas = $cms->getArticle()->getAll(member:$id);
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cooking Place</title>
    <link rel="shortcut icon" href="imagens/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/desktop.css" media="screen and (min-width: 1040px)">
    <link rel="stylesheet" href="estilos/profile.css">
    <link rel="stylesheet" href="estilos/profile-desktop.css" media="screen and (min-width: 1040px)">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <header id="cabecalho-principal">
        <h1>
            <a href="index.php">
                <picture>
                    <source media="(max-width: 600px)" srcset="imagens/logos/logo-pp.png">
                    <img src="imagens/logos/logo-p.png" alt="Logo do The Cooking Place">
                </picture>
            </a>
        </h1>
        <form action="search.php" method="get">
            <input type="search" name="search" id="search" placeholder="Pesquisa">
            <input type="submit" value="Pesquisar" class="escondido">
        </form>
        <div>
            <a href="create-edit-article.php"><span class="material-symbols-outlined">add_box</span></a>
            <a href="profile.php"><span class="material-symbols-outlined">account_circle</span></a>
        </div>
    </header>
    <br>
    <main>
        <header>
            <div id="foto_e_bio">
                <img src="imagens/fotos-perfil/<?= $membro['picture'] ?>" alt="Foto de perfil de <?= $membro['nome'] ?>">
                <p><?= $membro['bio'] ?></p>
            </div>
            <h1><?= $membro['nome'] ?></h1>
            <div id="estatisticas_numeros">
                <span>1M</span>
                <span>399</span>
                <span>69</span>
            </div>
            <div id="estatisticas_legenda">
                <span>seguidores</span>
                <span>a seguir</span>
                <span>receitas</span>
            </div>
            <p id="joined">Membro desde: <span><?= date('F Y', strtotime($membro['joined'])) ?></span></p>
        </header>
        <section>
            <div>
                <?php foreach ($receitas as $receita) { ?>
                    <a href="article.php?id=<?= $receita['id'] ?>"><img src="imagens/comida/<?= $receita['imagem_file'] ?>" alt="Foto de <?= $receita['titulo'] ?> publicada por <?= $receita['autor'] ?>"></a>
                <?php } ?>
        </section>
    </main>
<?php require_once 'includes/footer.php'; ?>
