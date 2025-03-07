<?php
require_once '../src/bootstrap.php';

$quiks = $cms->getQuik()->getAll();
$i = 1;
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
    <link rel="stylesheet" href="estilos/whats-happening.css">
    <link rel="stylesheet" href="estilos/whats-happening-desktop.css" media="screen and (min-width: 900px)">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body onresize="atualizarTamanho(); atualizarPosicao()" onload="atualizarTamanho(); atualizarPosicao()">
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
    <main id="principal">
        <h1 id="o-que-esta-a-acontecer">O que está a acontecer?</h1>
        <section id="todos-videos">
            <?php foreach ($quiks as $quik) { ?>
            <div class="video-individual">
                <video src="videos-verticais/<?= html_escape($quik['file']) ?>" id="video_<?= $i ?>" muted loop playsinline controls></video>
                <nav id="navegacao_<?= $i ?>">
                    <ul>
                        <li><a href="#"><img src="imagens/icons/banana-icon.png" alt="Ícone de banana"></a><p>20 mil</p></li>
                        <li><a href="#"><span class="material-symbols-outlined">thumb_down</span></a><p>20 mil</p></li>
                        <li><a href="#"><span class="material-symbols-outlined">chat</span></a><p>20 mil</p></li>
                        <li><a href="#"><span class="material-symbols-outlined">send</span></a><p>20 mil</p></li>
                        <li><a href="profile.php?id=<?= $quik['membro_id'] ?>"><img src="imagens/fotos-perfil/<?= $quik['picture'] ?>" alt="Foto de Perfil de <?= $quik['autor'] ?>"></a></li>
                    </ul>
                </nav>
                <div id="info">
                    <h1><?= html_escape($quik['titulo']) ?></h1>
                    <?php if ($quik['receita_acoplada_id'] == 0) { ?>
                        <p><?= html_escape($quik['descricao']) ?><?= html_escape($quik['descricao']) ?></p>
                    <?php } else { ?>
                        <a href="article.php?id=<?= $quik['receita_acoplada_id'] ?>"><?= html_escape($quik['descricao']) ?></a> 
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </section>
    </main>
    <script>
        function atualizarTamanho() {
            let largura = window.innerWidth;
            let altura = window.innerHeight;

            for (let id = 1; id <= 3; id++) {
                let video = window.document.querySelector(`video#video_${id}`)

                video.style.width = `${largura}px`
                video.style.height = `${altura}px`
            }
        }

        function atualizarPosicao() {
            let largura = window.innerWidth;
            let altura = window.innerHeight;

            for (let id = 1; id <= 3; id++) {
                let nav = window.document.querySelector(`nav#navegacao_${id}`)

                let top = altura - 225
                let left = largura - 35
                nav.style.top = `${top}px`
                nav.style.left = `${left}px`
            }
        }

        /*document.addEventListener("wheel", (event) => {
        event.preventDefault();
        let videos = document.querySelectorAll(".video-individual");
        let index = Math.round(window.scrollY / window.innerHeight);
        
        if (event.deltaY > 0) {
            index = index + 1, videos.length - 1;
        } else {
            index = index - 1, 0;
        }
        
        videos[index].scrollIntoView({ behavior: "smooth" });
    }, { passive: false });*/

        /*document.addEventListener("DOMContentLoaded", () => {
        let videos = document.querySelectorAll(".video-individual"); // Pega todos os vídeos
        let index = 0; // Começamos no primeiro vídeo
        let isScrolling = false; // Evita múltiplos eventos ao mesmo tempo

        document.addEventListener("wheel", (event) => {
            if (isScrolling) return; // Se já estamos rolando, ignoramos novos eventos
            isScrolling = true; // Bloqueia novos eventos enquanto a rolagem ocorre

            if (event.deltaY > 0) { 
                // Scroll para baixo
                index = Math.min(index + 1, videos.length - 1);
            } else {
                // Scroll para cima
                index = Math.max(index - 1, 0);
            }

            // Faz a rolagem suave até o próximo vídeo
            videos[index].scrollIntoView({ behavior: "smooth" });

            // Espera 800ms para permitir novo scroll
            setTimeout(() => {
                isScrolling = false;
            }, 800);

        }, { passive: false }); // Garante que o event.preventDefault() funcione
    });*/

    document.addEventListener("DOMContentLoaded", () => {
    let videos = document.querySelectorAll("video");

    // Configura o Observer
    let observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            let video = entry.target;

            if (entry.isIntersecting) {
                video.play(); // Toca o vídeo quando entra na tela
            } else {
                video.pause(); // Pausa quando sai da tela
                video.currentTime = 0; // Reinicia o vídeo quando sai
            }
        });
    }, { threshold: 0.6 }); // Só ativa quando pelo menos 60% do vídeo está visível

    // Aplica o Observer a cada vídeo
    videos.forEach(video => observer.observe(video));
});
    </script>
<?php require_once 'includes/footer.php'; ?>