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
                    <source media="(max-width: 700px)" srcset="imagens/comida/croppped/sushi.jpg">
                    <img src="imagens/comida/sushi.jpg" alt="Foto de sushi">
                </picture>
            </section>
            <section id="info">
                <h1 id="titulo-receita">Sushi</h1>
                <h2 id="descricao-receita">Como fazer sushi clássico de maneira simples e rápida</h2>
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
                        <p>Tempo de preparo: 45 min</p>
                        <p>26/01/2025</p>
                        <p>Nº pessoas: 6</p>
                    </div>
                </section>
            </section>
        </section>
        <section id="needs">
            <section id="ingredientes">
                <h2>Ingredientes</h2>
                <ul>
                    <li><input type="checkbox" name="salmao" id="salmao"><label for="salmao"> Salmão (500g)</label></li>
                    <li><input type="checkbox" name="abacate" id="abacate"><label for="abacate">Abacate (350g)</label></li>
                    <li><input type="checkbox" name="alga_nori" id="alga_nori"><label for="alga_nori">Alga Nori (150g)</label></li>
                    <li><input type="checkbox" name="molho_soja" id="molho_soja"><label for="">Molho soja (350ml)</label></li>
                    <li><input type="checkbox" name="arroz_sushi" id="arrow_shushi"><label for="molho_soja">Arrow Sushi (400g)</label></li>
                    <li><input type="checkbox" name="vinagre" id="vinagre"><label for="vinagre">Vinagre (150ml)</label></li>
                    <li><input type="checkbox" name="acucar" id="acucar"><label for="acucar">Açúcar (100g)</label></li>
                    <li><input type="checkbox" name="sal" id="sal"><label for="sal">Sal (50g)</label></li>
                </ul>
            </section>
            <section id="video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/nIoOv6lWYnk?si=BD3aeRopuRLQom_Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </section>
        </section>
        <section id="steps">
            <ul>
                <li><span>Passo 1:</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam eum quae voluptates quis, id cumque ab animi iste labore blanditiis dignissimos soluta cupiditate nesciunt magnam tempore atque expedita beatae officia.</li>
                <li><span>Passo 2:</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Est fugiat totam error, aperiam dolores repellat sequi tenetur dolor incidunt nostrum soluta quia possimus! Pariatur aspernatur hic mollitia laudantium sapiente quisquam!</li>
                <li><span>Passo 3:</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam eum quae voluptates quis, id cumque ab animi iste labore blanditiis dignissimos soluta cupiditate nesciunt magnam tempore atque expedita beatae officia.</li>
                <li><span>Passo 4:</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Est fugiat totam error, aperiam dolores repellat sequi tenetur dolor incidunt nostrum soluta quia possimus! Pariatur aspernatur hic mollitia laudantium sapiente quisquam!</li>
                <li><span>Passo 5:</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam eum quae voluptates quis, id cumque ab animi iste labore blanditiis dignissimos soluta cupiditate nesciunt magnam tempore atque expedita beatae officia.</li>
                <li><span>Passo 6:</span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Est fugiat totam error, aperiam dolores repellat sequi tenetur dolor incidunt nostrum soluta quia possimus! Pariatur aspernatur hic mollitia laudantium sapiente quisquam!</li>
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