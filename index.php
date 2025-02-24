<?php
require_once 'includes/database-conection.php';
require_once 'includes/functions.php';

$sql = "SELECT r.id, r.titulo, r.descricao, r.data, r.imagem_file, r.imagem_alt_text, r.membro_id,
        CONCAT(m.forename, ' ', m.surname) AS autor,
        m.picture
        FROM receita AS r
        JOIN membro AS m ON r.membro_id = m.id;";
$articles = pdo($pdo, $sql)->fetchAll();

$sql = "SELECT id, CONCAT(forename, ' ', surname) AS nome, picture 
        FROM membro 
        WHERE id = 1;";
$membro = pdo($pdo, $sql)->fetch();
$count = 0;
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cooking Place</title>
    <link rel="shortcut icon" href="imagens/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/desktop.css" media="screen and (min-width: 900px)">
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
            <a href="profile.php?id=<?= html_escape($membro['id']) ?>"><img src="imagens/fotos-perfil/<?= html_escape($membro['picture']) ?>" alt="Foto de perfil de <?= html_escape($membro['nome']) ?>" class="membro-foto-perfil"></a>
        </div>
    </header>
    <br>
    <main>
        <?php foreach ($articles as $article) { ?>
            <?php $data = postado_ha_x_horas($article['data']); ?>
            <article <?php if ($count == 0) { echo "id='primeiro-artigo'"; $count++; } ?>>
                <header>
                    <a href="profile.php?id=<?= $article['membro_id'] ?>">
                        <img src="imagens/fotos-perfil/<?= html_escape($article['picture']) ?>" alt="Foto de perfil de <?= html_escape($article['autor']) ?>">
                        <span class="nome"><?= html_escape($article['autor']) ?></span>
                    </a>
                    <span class="data">Há <?php echo "$data[0] $data[1]"; ?></span>
                    <br>
                </header>
                <section>
                    <a href="article.php?id=<?= $article['id'] ?>"><img src="imagens/comida/<?= html_escape($article['imagem_file']) ?>" alt="<?= html_escape($article['imagem_alt_text']) ?>"></a>
                </section>
                <aside class="aside-principal">
                    <section>
                        <div class="icones">
                            <span class="icones-reacao"><img src="imagens/icons/hamburger-icon.png" alt="Like hamburguer"></span>
                            <span class="icones-reacao"><img src="imagens/icons/comment-icon.png" alt="Ícone comentário"></span>
                            <span class="icones-reacao"><img src="imagens/icons/share-icon.png" alt="Ícone comentário"></span>
                        </div>
                        <div class="numeros">
                            <span>3231</span>
                            <span>100</span>
                            <span>55</span>
                        </div>
                        <h2><?= html_escape($article['titulo']) ?></h2>
                        <p><?= html_escape($article['descricao']) ?></p>
                    </section>
                    <aside>
                        <a href="#">Ver os 100 comentários</a>
                    </aside>
                </aside>
            </article>
        <?php } ?>
    </main>
<?php require_once 'includes/footer.php'; ?>
