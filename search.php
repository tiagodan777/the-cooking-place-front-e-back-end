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
        <div>
            <a href="article.php">
                <img src="imagens/comida/sushi.jpg" alt="Foto de Sushi">
            </a>
            <footer class="info">
                <p class="author">Tiago Daniel</p>
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
        <div>
            <a href="article.php">
                <img src="imagens/comida/comida-brasileira.jpg" alt="Foto de Comida Brasileira">
            </a>
            <footer class="info">
                <p class="author">Inês Bastos</p>
                <div class="stats">
                    <div class="likes">
                        <span>20 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>550 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/polvo.jpg" alt="Foto de Polvo">
            </a>
            <footer class="info">
                <p class="author">Tomás Dias</p>
                <div class="stats">
                    <div class="likes">
                        <span>10 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>50 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/hamburger.jpg" alt="Foto de Hamburger">
            </a>
            <footer class="info">
                <p class="author">Rodrigo Reis</p>
                <div class="stats">
                    <div class="likes">
                        <span>100 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>1 M</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/sushi.jpg" alt="Foto de Sushi">
            </a>
            <footer class="info">
                <p class="author">Tiago Daniel</p>
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
        <div>
            <a href="article.php">
                <img src="imagens/comida/comida-brasileira.jpg" alt="Foto de Comida Brasileira">
            </a>
            <footer class="info">
                <p class="author">Inês Bastos</p>
                <div class="stats">
                    <div class="likes">
                        <span>20 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>550 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/polvo.jpg" alt="Foto de Polvo">
            </a>
            <footer class="info">
                <p class="author">Tomás Dias</p>
                <div class="stats">
                    <div class="likes">
                        <span>10 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>50 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/hamburger.jpg" alt="Foto de Hamburger">
            </a>
            <footer class="info">
                <p class="author">Rodrigo Reis</p>
                <div class="stats">
                    <div class="likes">
                        <span>100 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>1 M</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/sushi.jpg" alt="Foto de Sushi">
            </a>
            <footer class="info">
                <p class="author">Tiago Daniel</p>
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
        <div>
            <a href="article.php">
                <img src="imagens/comida/comida-brasileira.jpg" alt="Foto de Comida Brasileira">
            </a>
            <footer class="info">
                <p class="author">Inês Bastos</p>
                <div class="stats">
                    <div class="likes">
                        <span>20 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>550 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/polvo.jpg" alt="Foto de Polvo">
            </a>
            <footer class="info">
                <p class="author">Tomás Dias</p>
                <div class="stats">
                    <div class="likes">
                        <span>10 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>50 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/hamburger.jpg" alt="Foto de Hamburger">
            </a>
            <footer class="info">
                <p class="author">Rodrigo Reis</p>
                <div class="stats">
                    <div class="likes">
                        <span>100 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>1 M</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/sushi.jpg" alt="Foto de Sushi">
            </a>
            <footer class="info">
                <p class="author">Tiago Daniel</p>
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
        <div>
            <a href="article.php">
                <img src="imagens/comida/comida-brasileira.jpg" alt="Foto de Comida Brasileira">
            </a>
            <footer class="info">
                <p class="author">Inês Bastos</p>
                <div class="stats">
                    <div class="likes">
                        <span>20 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>550 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/polvo.jpg" alt="Foto de Polvo">
            </a>
            <footer class="info">
                <p class="author">Tomás Dias</p>
                <div class="stats">
                    <div class="likes">
                        <span>10 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>50 mil</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
        <div>
            <a href="article.php">
                <img src="imagens/comida/hamburger.jpg" alt="Foto de Hamburger">
            </a>
            <footer class="info">
                <p class="author">Rodrigo Reis</p>
                <div class="stats">
                    <div class="likes">
                        <span>100 mil</span>
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="views">
                        <span>1 M</span>
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                </div>
            </footer>
        </div>
    </main>
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


