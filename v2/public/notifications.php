<?php
require_once '../src/bootstrap.php';

$link = '';

$notificacoes = $cms->getNotification()->getAll(1);
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
    <link rel="stylesheet" href="estilos/notificacoes.css">
    <link rel="stylesheet" href="estilos/notificacoes-desktop.css" media="screen and (min-width: 900px)">
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
        <h1>Notificações</h1>
        <?php foreach ($notificacoes as $notificacao) { ?>
            <?php
                if ($notificacao['mensagem'] == "começou a seguir-te") {
                    $link = 'profile.php?id=' . $notificacao['emissor_id'];
                } elseif ($notificacao['mensagem'] == "publicou uma receita" || $notificacao['mensagem'] == "gostou da tua receita") {
                    $link = 'article.php?id=' . $notificacao['emissor_id'];
                }    
            ?>
            <div>
                <a href="<?= $link ?>">
                    <section id="perfil">
                        <div>
                            <img src="imagens/fotos-perfil/<?= html_escape($notificacao['picture'] ?? 'blank.jpg') ?>" alt="Foto perfil de <?= html_escape($notificacao['emissor']) ?>">
                        </div>
                    </section>
                    <section id="informacao">
                        <p><span class="perfil"><?= $notificacao['emissor'] ?></span> <?= $notificacao['mensagem'] ?></p>
                    </section>
                </a>
                <section id="seguir">
                    <?php if ($notificacao['mensagem'] == 'começou a seguir-te') { ?>
                        <a href="profile.php?id=<?= $notificacao['emissor_id'] ?>">Seguir</a>
                    <?php } ?>
                </section>
            </div>
        <?php } ?>
    </main>
<?php require_once 'includes/footer.php'; ?>
