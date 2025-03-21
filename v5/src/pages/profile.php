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

if (mb_strtolower($parts[2]) != mb_strtolower($receitas[0]['seo_member'])) {
    redirect(DOC_ROOT . 'article/' . $id . '/' . $receitas[0]['seo_member'], [], 301);
}

$data['receitas'] = $receitas;
$data['membro'] = $membro;

echo $twig->render('profile.html', $data);
?>
