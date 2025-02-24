<?php
require_once '../includes/database-conection.php';
require_once '../includes/functions.php';

$success = $_GET['success'] ?? null;
$failure = $_GET['failure'] ?? null;

$sql = "SELECT id, nome, descricao 
        FROM categoria;";

$categorias = pdo($pdo, $sql)->fetchAll();

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
    <link rel="stylesheet" href="../estilos/admin/categories.css">
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
            <a href="../profile.html"><img src="../imagens/fotos-perfil/<?= html_escape($membro['picture']) ?>" alt="Foto de perfil de <?= html_escape($membro['nome']) ?>" class="membro-foto-perfil"></a>
        </div>
    </header>
    <br>
    <main>
        <section>
            <header>
                <h1>Categorias</h1>
                <?php if ($success) { ?><div class="alert-success"><?= $success ?></div> <?php } ?>
                <?php if ($failure) { ?><div class="alter-failure"><?= $failure ?></div> <?php } ?>
                <a href="category.html">Adicionar nova categoria</a>
            </header>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col" class="mais-a-esquerda">Editar</th>
                        <th scope="col" class="mais-a-esquerda">Apagar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria) { ?>
                    <tr>
                        <th scope="row" class="titulo-linha"><?= html_escape($categoria['nome']) ?></th>
                        <td><a href="category.php?id=<?= $categoria['id'] ?>">Editar</a></td>
                        <td><a href="category-delete.php?id=<?= $categoria['id'] ?>" class="diferente">Apagar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
<?php require_once 'includes/footer.php'; ?>