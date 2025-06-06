<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cooking Place</title>
    <link rel="shortcut icon" href="imagens/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/desktop.css" media="screen and (min-width: 900px)">
    <link rel="stylesheet" href="../estilos/error-page.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <header id="cabecalho-principal">
        <h1>
            <a href="index.php">
                <picture>
                    <source media="(max-width: 600px)" srcset="imagens/logos/logo-pp.png">
                    <img src="../imagens/logos/logo-p.png" alt="Logo do The Cooking Place">
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
        <div id="texto">
            <h1>Desculpa, não conseguimos encontrar essa página</h1>
            <p>Podes tentar acessar a <a href="index.php">página principal</a> ou <a href="mailto:tiagoamdaniel@gmail.com">contactar-nos</a></p>
        </div>
        <img src="../imagens/ilustracoes/chef-espantado.jpg" alt="Ilustração de um Chef espantado">
    </main>
    <footer>
        <a href="index.php"><span class="material-symbols-outlined aparece-desktop">home</span> <span class="descricao-icone">Página Principal</span></a>
        <a href="notifications.php"><span class="material-symbols-outlined aparece-desktop">favorite</span> <span class="descricao-icone nao-destaque">Notificações</span></a>
        <a href="all-messages.php"><span class="material-symbols-outlined">send</span> <span class="descricao-icone nao-destaque">Mensagens</span></a>
        <a href="whats-happening.php"><span class="material-symbols-outlined aparece-desktop">star</span> <span class="descricao-icone nao-destaque">O que está a acontecer?</span></a>
        <a href="profile.php>"><img src="../imagens/fotos-perfil/tiago-p.jpg" alt="Foto de perfil deTiago" class="membro-foto-perfil"> <span class="descricao-icone nao-destaque">Perfil</span></a>
        <a href="create-edit-article.php"><span class="material-symbols-outlined aparece-mobile">add_box</span></a>
        <a href="search.php"><span class="material-symbols-outlined aparece-mobile">search</span></a>
    </footer>
</body>
</html>
<?php exit; ?>
