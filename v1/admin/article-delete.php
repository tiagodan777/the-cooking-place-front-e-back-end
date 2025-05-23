<?php
require_once '../includes/database-conection.php';
require_once '../includes/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$path = '../imagens/comida/';

if (!$id) {
    redirect('articles.php', ['failure' => 'Receita não encontrada']);
}

$sql = "SELECT id, titulo, imagem_file FROM receita WHERE id = :id";
$receita = pdo($pdo, $sql, [$id])->fetch();
if (!$receita) {
    redirect('articles.php', ['failure' => 'Receita não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (file_exists($path . $receita['imagem_file']) && $receita['imagem_file'] != null) {
        unlink($path . $receita['imagem_file']);
    }
    $sql = "DELETE FROM receita where id = :id";
    pdo($pdo, $sql, [$id]);
    redirect('articles.php', ['success' => 'Receita apagada com sucesso']);
}
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
    <link rel="stylesheet" href="../estilos/create-edit-article.css">
    <link rel="stylesheet" href="../estilos/create-edit-article-desktop.css" media="screen and (min-width: 900px)">
    <link rel="stylesheet" href="../estilos/article-detele.css">
    <link rel="stylesheet" href="../estilos/article-detele-desktop.css" media="screen and (min-width: 900px)">
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
        <section id="apagar">
            <h2>Apagar Receita</h2>
            <section id="dados">
                <p>Confirma para apagar a receita: <?= html_escape($receita['titulo']) ?></p>
                <img src="../imagens/comida/<?= html_escape($receita['imagem_file']) ?>" alt="Foto de <?= html_escape($receita['titulo']) ?>">
            </section>
            <section id="opcoes">
                <form action="article-delete.php?id=<?= $id ?>" method="post">
                    <a href="articles.php">Cancelar</a>
                    <input type="submit" value="Confirmar">
                </form>
            </section>
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