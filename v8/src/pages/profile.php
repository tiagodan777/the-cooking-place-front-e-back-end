<?php
 
if (!$id) {
    include 'error-page.php';
}

$membro = $cms->getMember()->get($id);
if (!$membro) {
    include 'error-page.php';
}

$conteudos = $cms->getContent()->get(member:$id);
$seguem_se = $cms->getFollow()->get($cookie->id, $id);

if (mb_strtolower($parts[2]) != mb_strtolower($membro['seo_name'])) {
    redirect(DOC_ROOT . 'profile/' . $id . '/' . $membro['seo_name'], [], 301);
}

$data['conteudos'] = $conteudos;
$data['membro'] = $membro;
$data['seguem_se'] = $seguem_se;

echo $twig->render('profile.html', $data);
?>
