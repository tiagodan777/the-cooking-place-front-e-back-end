<?php
require_once '../includes/database-conection.php';
require_once '../includes/functions.php';

$sql = "SELECT COUNT(*) FROM categoria;";
$categorias = pdo($pdo, $sql)->fetchColumn();

$sql = "SELECT COUNT(*) FROM receita;";
$receitas = pdo($pdo, $sql)->fetchColumn();

$sql = "SELECT COUNT(*) FROM membro;";
$membros = pdo($pdo, $sql)->fetchColumn();

$sql = "SELECT id, CONCAT(forename, ' ', surname) AS nome, picture 
        FROM membro 
        WHERE id = 1;";
        $membro = pdo($pdo, $sql)->fetch();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cooking Place</title>
    <link rel="shortcut icon" href="../imagens/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/desktop.css" media="screen and (min-width: 900px)">
    <link rel="stylesheet" href="../estilos/admin/style.css">
    <link rel="stylesheet" href="../estilos/admin/category.css">
    <link rel="stylesheet" href="../estilos/admin/category-desktop.css" media="screen and (min-width: 900px">
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
        <section>
            <header>
                <h1>Admin</h1>
            </header>
            <table>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Contagem</th>
                        <th scope="col" class="mais-a-esquerda">Adicionar</th>
                        <th scope="col" class="mais-a-esquerda">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="titulo-linha">Categorias</th>
                        <td><?= $categorias ?></td>
                        <td><a href="category.php">Adicionar</a></td>
                        <td><a href="categories.php" class="diferente">Ver</a></td>
                    </tr>
                    <tr>
                        <th scope="row" class="titulo-linha">Receitas</th>
                        <td><?= $receitas ?></td>
                        <td><a href="create-edit-article.html">Adicionar</a></td>
                        <td><a href="articles.html" class="diferente">Ver</a></td>
                    </tr>
                    <tr>
                        <th scope="row" class="titulo-linha">Membros</th>
                        <td><?= $membros ?></td>
                        <td><a href="members.html">Adicionar</a></td>
                        <td><a href="members.html" class="diferente">Ver</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <a href="index.php"><span class="material-symbols-outlined aparece-desktop">home</span> <span class="descricao-icone">Página Principal</span></a>
        <a href="notifications.php"><span class="material-symbols-outlined aparece-desktop">favorite</span> <span class="descricao-icone nao-destaque">Notificações</span></a>
        <a href="all-messages.php"><span class="material-symbols-outlined">send</span> <span class="descricao-icone nao-destaque">Mensagens</span></a>
        <a href="whats-happening.php"><span class="material-symbols-outlined aparece-desktop">star</span> <span class="descricao-icone nao-destaque">O que está a acontecer?</span></a>
        <a href="profile.php?id=<?= $membro['id'] ?>"><img src="../imagens/fotos-perfil/<?= html_escape($membro['picture']) ?>" alt="Foto de perfil de <?= html_escape($membro['nome']) ?>" class="membro-foto-perfil"> <span class="descricao-icone nao-destaque">Perfil</span></a>
        <a href="create-edit-article.php"><span class="material-symbols-outlined aparece-mobile">add_box</span></a>
        <a href="search.php"><span class="material-symbols-outlined aparece-mobile">search</span></a>
    </footer>
</body>
</html>