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

if (mb_strtolower($parts[2]) != mb_strtolower($membro['seo_name'])) {
    redirect(DOC_ROOT . 'profile/' . $id . '/' . $membro['seo_name'], [], 301);
}

$data['receitas'] = $receitas;
$data['membro'] = $membro;

echo $twig->render('profile.html', $data);
?>
