<?php
require_once '../includes/database-conection.php';
require_once '../includes/functions.php';

$sql = "SELECT r.id, r.titulo, r.data, r.imagem_file, CONCAT(m.forename, ' ', m.surname) AS autor
        FROM receita AS r
        JOIN membro AS m ON r.membro_id = m.id;";
$receitas = pdo($pdo, $sql)->fetchAll();

$success = $_GET['success'] ?? null;
$failure = $_GET['failure'] ?? null;
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
    <link rel="stylesheet" href="../estilos/admin/articles.css">
    <link rel="stylesheet" href="../estilos/admin/articles-desktop.css" media="screen and (min-width: 900px)">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <header id="cabecalho-principal">
        <h1>
            <a href="index.php">
                <picture>
                    <source media="(max-width: 600px)" srcset="../imagens/logos/logo-pp.png">
                    <img src="../imagens/logos/logo-p.png" alt="Logo do The Cooking Place">
                </picture>
            </a>
        </h1>
        <form action="#" method="get">
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
                <h1>Receitas</h1>
                <a href="create-edit-article.html">Adicionar nova receita</a>
                <?php if ($success) { ?> <div class="alert-success"><?= $success ?></div> <?php } ?>
                <?php if ($failure) { ?> <div class="alert-failure"><?= $failure ?></div> <?php } ?>
            </header>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Imagem</th>
                        <th scope="col">Título</th>
                        <th scope="col">Publicado</th>
                        <th scope="col">Autor</th>
                        <th scope="col"><a href="create-edit-article.html">Editar</a></th>
                        <th scope="col"><a href="article-delete.html">Apagar</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($receitas as $receita) { ?>
                        <tr>
                            <td><img src="../imagens/comida/<?= html_escape($receita['imagem_file']) ?>" alt="Foto de <?= html_escape($receita['titulo']) ?> publicada por <?= html_escape($receita['autor']) ?>"></td>
                            <td><?= html_escape($receita['titulo']) ?></td>
                            <td><?= date('d F Y', strtotime($receita['data'])) ?></td>
                            <td><?= html_escape($receita['autor']) ?></td>
                            <td><a href="create-edit-article.php?id=<?= $receita['id'] ?>" class="editar">Editar</a></td>
                            <td><a href="article-delete.php?id=<?= $receita['id'] ?>" class="apagar">Apagar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <a href="../pagina-principal.html"><span class="material-symbols-outlined aparece-desktop">home</span> <span class="descricao-icone">Página Principal</span></a>
        <a href="../notifications.html"><span class="material-symbols-outlined aparece-desktop">favorite</span> <span class="descricao-icone nao-destaque">Notificações</span></a>
        <a href="../all-messages.html"><span class="material-symbols-outlined">send</span> <span class="descricao-icone nao-destaque">Mensagens</span></a>
        <a href="../whats-happening.html"><span class="material-symbols-outlined aparece-desktop">star</span> <span class="descricao-icone nao-destaque">O que está a acontecer?</span></a>
        <a href="../profile.html"><span class="material-symbols-outlined aparece-desktop">account_circle</span> <span class="descricao-icone nao-destaque">Perfil</span></a>
        <a href="../create-edit-article.html"><span class="material-symbols-outlined aparece-mobile">add_box</span></a>
        <a href="#"><span class="material-symbols-outlined aparece-mobile">search</span></a>
    </footer>
</body>
</html>