<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cooking Place</title>
    <link rel="shortcut icon" href="imagens/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/desktop.css" media="screen and (min-width: 900px)">
    <link rel="stylesheet" href="estilos/create-edit-article.css">
    <link rel="stylesheet" href="estilos/create-edit-article-desktop.css" media="screen and (min-width: 900px)">
    <link rel="stylesheet" href="estilos/article-detele.css">
    <link rel="stylesheet" href="estilos/article-detele-desktop.css" media="screen and (min-width: 900px)">
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
        <section id="apagar">
            <h2>Apagar Receita</h2>
            <section id="dados">
                <p>Confirma para apagar a receita: Sushi</p>
                <img src="imagens/comida/sushi.jpg" alt="Foto de sushi">
            </section>
            <section id="opcoes">
                <form action="#" method="post">
                    <a href="index.php">Cancelar</a>
                    <input type="submit" value="Confirmar">
                </form>
            </section>
        </section>
    </main>
<?php require_once 'includes/footer.php'; ?>