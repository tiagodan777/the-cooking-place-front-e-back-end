<?php
require_login($cookie);

if (!$id) {
    include 'error-page.php';
}

$membro = $cms->getMember()->get($id);
if (!$membro) {
    include 'error-page.php';
}

$receitas = $cms->getArticle()->getAll(member:$id);

$data['receitas'] = $receitas;
$data['membro'] = $membro;

echo $twig->render('profile.html', $data);
?>
