<?php
require_once 'includes/database-conection.php';
require_once 'includes/functions.php';

$term = filter_input(INPUT_GET, 'search');
$show = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 15;
$from = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0;

$count = 0;
$receitas = [];
$arguments = [];

if ($term) {
    $arguments['term1'] = '%' . $term . '%';
    $arguments['term2'] = '%' . $term . '%';
    $arguments['term3'] = '%' . $term . '%';
    $arguments['term4'] = '%' . $term . '%';
    $arguments['term5'] = '%' . $term . '%';

    $sql = "SELECT COUNT(titulo) FROM receita
            WHERE titulo LIKE :term1
            OR descricao LIKE :term2
            OR ingredientes LIKE :term3
            OR passos_preparacao LIKE :term4
            OR keywords LIKE :term5;";
    $count = pdo($pdo, $sql, $arguments)->fetchColumn();

    if ($count > 0) {
        $arguments['show'] = $show;
        $arguments['from'] = $from;
        $sql = "SELECT r.id, r.titulo, r.descricao, r.imagem_file, r.imagem_alt_text
                FROM receita AS r
                WHERE titulo LIKE :term1
                OR descricao LIKE :term2
                OR ingredientes LIKE :term3
                OR passos_preparacao LIKE :term4
                OR keywords LIKE :term5
                LIMIT :show
                OFFSET :from;";
        $receitas = pdo($pdo, $sql, $arguments)->fetchAll();
    }
}

if ($count > $show) {
    $total_pages = ceil($count / $show);
    $current_page = ceil($from / $show) + 1;
}
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
    <link rel="stylesheet" href="estilos/search.css">
    <link rel="stylesheet" href="estilos/search-desktop.css" media="screen and (min-width: 900px)">
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
    <section id="opcoes">
        <section>
            <div><label for="receitas" onclick="mudaPosicao(0)" id="label-0" style="font-weight: bold;">Receitas</label> <input type="radio" name="opcao" id="receitas" checked></div>
            <div><label for="quiks" onclick="mudaPosicao(1)" id="label-1">Quiks</label> <input type="radio" name="opcao" id="quiks"></div>
            <div><label for="utilizadores" onclick="mudaPosicao(2)" id="label-2">Utilizadores</label> <input type="radio" name="opcao" id="utilizadores"></div>
        </section>
        <div id="linha-principal"><div id="linha-que-move"></div></div>
    </section>
    <main>
        <?php foreach ($receitas as $receita) { ?>
            <div>
                <a href="article.php?id=<?= $receita['id'] ?>">
                    <img src="imagens/comida/<?= html_escape($receita['imagem_file']) ?>" alt="<?= html_escape($receita['imagem_alt_text']) ?>">
                </a>
                <footer class="info">
                    <h1><?= html_escape($receita['titulo']) ?></h1>
                    <h2><?= html_escape($receita['descricao']) ?></h2>
                    <div class="stats">
                        <div class="likes">
                            <span>10 mil</span>
                            <span class="material-symbols-outlined">favorite</span>
                        </div>
                        <div class="views">
                            <span>250 mil</span>
                            <span class="material-symbols-outlined">visibility</span>
                        </div>
                    </div>
                </footer>
            </div>
        <?php } ?>
    </main>
    <aside>
        <?php if ($count > $show) { ?>
            <nav class="pagination">
                <ul>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li><a href="?search=<?= $term ?>&show=<?= $show ?>&from=<?= (($i - 1) * $show) ?>" class="<?= ($i == $current_page) ? 'ativo' : '' ?>"><?= $i ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } ?>
    </aside>
    <script>
        function mudaPosicao(pos) {
            let posicoes = []
            if (window.innerWidth <= 900) {
                posicoes = [0, 30, 69]
            } else {
                posicoes = [0, 37, 75]
            }
            let linha = window.document.querySelector('div#linha-que-move')
            for (let c = 0; c <= 2; c++) {
                let label = window.document.querySelector(`label#label-${c}`)
                label.style.fontWeight = 'normal';
            }

            linha.style.marginLeft = `${posicoes[pos]}%`
            linha.style.transition = '0.3s'

            let label = window.document.querySelector(`label#label-${pos}`)
            label.style.fontWeight = 'bold'
            label.style.transition = '0.3s'
        }
    </script>
<?php require_once 'includes/footer.php'; ?>


