<?php
//require_once '../../src/bootstrap.php';
$membro = $cms->getMember()->get(1);
?>
<footer>
        <a href="index.php"><span class="material-symbols-outlined aparece-desktop">home</span> <span class="descricao-icone">Página Principal</span></a>
        <a href="notifications.php"><span class="material-symbols-outlined aparece-desktop">favorite</span> <span class="descricao-icone nao-destaque">Notificações</span></a>
        <a href="all-messages.php"><span class="material-symbols-outlined">send</span> <span class="descricao-icone nao-destaque">Mensagens</span></a>
        <a href="whats-happening.php"><span class="material-symbols-outlined aparece-desktop">star</span> <span class="descricao-icone nao-destaque">O que está a acontecer?</span></a>
        <a href="profile.php?id=<?= $membro['id'] ?>"><img src="imagens/fotos-perfil/<?= html_escape($membro['picture']) ?>" alt="Foto de perfil de <?= html_escape($membro['nome']) ?>" class="membro-foto-perfil"> <span class="descricao-icone nao-destaque">Perfil</span></a>
        <a href="create-edit-article.php"><span class="material-symbols-outlined aparece-mobile">add_box</span></a>
        <a href="search.php"><span class="material-symbols-outlined aparece-mobile">search</span></a>
    </footer>
    
</body>
</html>