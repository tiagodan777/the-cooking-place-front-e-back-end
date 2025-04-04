<?php 
require_once '../includes/database-conection.php';
require_once '../includes/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$categoria = '';

if (!$id) {
    redirect('categories.php', ['failure' => 'Categoria não encontrada']);
}

$sql = "SELECT nome FROM categoria
        WHERE id = :id;";
$categoria = pdo($pdo, $sql, [$id])->fetchColumn();
if (!$categoria) {
    redirect('categories.php', ['failure' => 'Categoria não encontrada']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $sql = "DELETE FROM categoria 
                WHERE id = :id;";
        pdo($pdo, $sql, [$id]);
        redirect('categories.php', ['success' => 'Categoria apagada']);
    } catch (PDOException $e) {
        if ($e->errorInfo[1] === 1451) {
            redirect('categories.php', ['failure' => 'Existem artigos que pertencem a esta categoria que têm de ser apagados ou colocados noutra categoria']);
        } else {
            throw $e;
        }
    }
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
            <h2>Apagar Categoria</h2>
            <section id="dados">
                <p>Confirma para apagar a categoria: <span><?= $categoria ?></span></p>
            </section>
            <section id="opcoes">
                <form action="category-delete.php?id=<?= $id ?>" method="post">
                    <a href="categories.php">Cancelar</a>
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