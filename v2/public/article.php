<?php
require_once '../src/bootstrap.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    include 'error-page.php';
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    include 'error-page.php';
}

$ingredientes = explode(',', $receita['ingredientes']);
$quantidades = explode(',', $receita['quantidades']);
$passos_preparacao = explode('#', $receita['passos_preparacao']);
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nome da Receita</title>
    <link rel="stylesheet" href="estilos/style.css">
    <!--<link rel="stylesheet" href="estilos/desktop.css" media="screen and (min-width: 1040px)">-->
    <link rel="stylesheet" href="estilos/article.css">
    <link rel="stylesheet" href="estilos/article-desktop.css" media="screen and (min-width: 700px)">
    <link rel="stylesheet" href="estilos/article-desktop.css" media="screen and (min-width: 1041px)">
    <link rel="stylesheet" href="estilos/article-gigante.css" media="screen and (min-width: 1200px)">
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
        <section id="topo">
            <section id="imagem">
                <picture>
                    <source media="(max-width: 700px)" srcset="imagens/comida/croppped/<?= $receita['imagem_file'] ?>">
                    <img src="imagens/comida/<?= $receita['imagem_file'] ?>" alt="Foto de <?= html_escape($receita['titulo']) ?> publicada por <?= $receita['autor'] ?>">
                </picture>
            </section>
            <section id="info">
                <h1 id="titulo-receita"><?= html_escape($receita['titulo']) ?></h1>
                <h2 id="descricao-receita"><?= html_escape($receita['descricao']) ?></h2>
                <section>
                    <div>
                        <div id="reacoes">
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
                        </div>
                    </div>
                    <div>
                        <p>Tempo de preparo: <?= html_escape($receita['tempo_preparo']) ?> <?= html_escape($receita['unidade_tempo']) ?></p>
                        <p>Data: <?= date('d F Y', strtotime(html_escape($receita['data']))) ?></p>
                        <p>Nº pessoas: <?= html_escape($receita['numero_pessoas']) ?></p>
                        <br>
                        <a href="profile.php?id=<?= $receita['id'] ?>" id="user"> <img src="imagens/fotos-perfil/<?= html_escape($receita['picture']) ?>" alt="Foto de perfil de <?= html_escape($receita['autor']) ?>"><?= html_escape(html_escape($receita['autor'])) ?></a>
                    </div>
                </section>
            </section>
        </section>
        <section id="needs">
            <section id="ingredientes">
                <h2>Ingredientes</h2>
                <ul>
                    <?php
                        $i = 0;
                        while ($i < count($ingredientes)) {
                     ?>
                        <li><input type="checkbox" name="<?= strtolower($ingredientes[$i]) ?>" id="<?= strtolower($ingredientes[$i]) ?>"><label for="<?= strtolower($ingredientes[$i]) ?>"><?= html_escape($ingredientes[$i]) ?> (<?= $quantidades[$i] ?>)</label></li>
                    <?php
                           $i++; 
                        } 
                    ?>
                </ul>
            </section>
            <section id="video">
                <?= $receita['video_file'] ?>
            </section>
        </section>
        <section id="steps">
            <ul>
                <?php foreach ($passos_preparacao as $passo) { ?>
                    <li><span>Passo </span><?= $passo ?></li>
                <?php } ?>
            </ul>
        </section>
        <aside>
            <h3>Comentários</h3>
            <article>
                <h4>Título de Comentário 1</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime perspiciatis et repudiandae, reiciendis inventore, dolores ratione magnam earum assumenda tenetur esse tempore saepe, rerum fugit illo facilis neque eaque accusantium!</p>
            </article>
            <article>
                <h4>Título de Comentário 2</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime perspiciatis et repudiandae, reiciendis inventore, dolores ratione magnam earum assumenda tenetur esse tempore saepe, rerum fugit illo facilis neque eaque accusantium!</p>
            </article>
            <article>
                <h4>Título de Comentário 3</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime perspiciatis et repudiandae, reiciendis inventore, dolores ratione magnam earum assumenda tenetur esse tempore saepe, rerum fugit illo facilis neque eaque accusantium!</p>
            </article>
            <article>
                <h4>Título de Comentário 4</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime perspiciatis et repudiandae, reiciendis inventore, dolores ratione magnam earum assumenda tenetur esse tempore saepe, rerum fugit illo facilis neque eaque accusantium!</p>
            </article>
        </aside>
    </main>
<?php require_once 'includes/footer.php'; ?>