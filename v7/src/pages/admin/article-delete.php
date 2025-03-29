<?php
is_admin($cookie->role);

$path = APP_ROOT . 'public/imagens/comida/';

if (!$id) {
    redirect(DOC_ROOT . 'articles/', ['failure' => 'Receita não encontrada 0']);
}

$receita = $cms->getArticle()->get($id);
if (!$receita) {
    redirect(DOC_ROOT . 'articles/', ['failure' => 'Receita não encontrada 1']);
}

$membro = $cms->getMember()->get(1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imagem_apagada = $cms->getArticle()->imageDelete($id, $path);
    $artigo_apagado = $cms->getArticle()->delete($id);
    if ($imagem_apagada && $artigo_apagado) {
        redirect(DOC_ROOT . 'articles/', ['success' => 'Receita apagada com sucesso']);
    } else {                                                  // Otherwise
        throw new Exception('Não foi possível apagar a receita');      // Throw an exception
    }
}

$data['receita'] = $receita;
$data['membro'] = $membro;

echo $twig->render('admin/article-delete.html', $data);
?>
