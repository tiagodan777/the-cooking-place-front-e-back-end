<?php
require_login($cookie);

$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect('profile.php', ['failure' => 'Receita não encontrada']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect('profile.php', ['failure' => 'Receita não encontrada']);
}

$membro = $cms->getMember()->get(1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cms->getArticle()->imageDelete($id, $path);
    $cms->getArticle()->delete($id);
    redirect('profile.php', ['success' => 'Receita apagada com sucesso']);
}

$data['receita'] = $receita;
$data['membro'] = $membro;

echo $twig->render('article-delete.html', $data);
?>
