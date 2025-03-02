<?php
require_once '../includes/database-conection.php';
require_once '../includes/functions.php';
require_once '../includes/validade.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$categoria = [
    'id' => $id,
    'nome' => '',
    'descricao' => '',
];
$erros = [
    'warning' => '',
    'nome' => '',
    'descricao' => '',
];

if ($id) {
    $sql = "SELECT id, nome , descricao
            FROM categoria
            WHERE id = :id;";
    $categoria = pdo($pdo, $sql, [$id])->fetch();
    if (!$categoria) {
        redirect('categories.php', ['falha' => 'Categoria não encontrada']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria['nome'] = $_POST['nome'];
    $categoria['descricao'] = $_POST['descricao'];

    $erros['nome'] = is_text($categoria['nome'], 1, 32) ? '' : 'O nome da categoria deve ter entre 1 e 32 caracteres';
    $erros['descricao'] = is_text($categoria['descricao'], 1, 256) ? '' : 'A descrição da categoria deve ter entre 1 e 256 catacteres';

    $invalido = implode($erros);

    if ($invalido) {
        $erros['warning'] = 'Por favor corrige os erros';
    } else {
        $arguments = $categoria;
        if ($id) {
            $sql = "UPDATE categoria
                    SET nome = :nome
                    descricao = :descricao
                    WHERE id = :id";
        } else {
            unset($arguments['id']);
            $sql = "INSERT INTO categoria (nome, descricao) VALUES
            (:nome, :descricao);";
        }

        try {
            pdo($pdo, $sql, $arguments);
            redirect('categories.php', ['success' => 'Categoria guardada']);
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                $erros['warning'] = 'O nome "' . $arguments['nome'] . '" já foi utilizado noutra categoria';
            } else {
                throw $e;
            }
        }
    }
}

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
            <h1>Editar Categoria</h1>
            <?php if ($erros['warning']) { ?>
                <div class="alter-failure"><?= $erros['warning'] ?></div>
            <?php } ?>
            <form action="category.php" method="post">
                <div id="div-nome">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="<?= html_escape($categoria['nome']) ?>">
                    <span class="error"><?= $erros['nome'] ?></span>
                </div>
                <div id="div-descricao">
                    <label for="descricao">Descrição:</label>
                    <textarea name="descricao" id="descricao" cols="30" rows="7"><?= html_escape($categoria['descricao']) ?></textarea>
                    <span class="error"><?= $erros['descricao'] ?></span>
                </div>
                <input type="submit" value="Guardar">
            </form>
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