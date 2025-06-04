<?php
use TiagoDaniel\Validate\Validate;

$id_opiniao = '';
if ($id_opiniao == '') {
    $id_opiniao = filter_input(INPUT_GET, 'id_opiniao', FILTER_VALIDATE_INT);
}
$form_id = $id;
$opinioes = $cms->getOpinion()->getAll($id);

$autor_conteudo_id = $cms->getContent()->getMemberIdByContentId($form_id);

$opiniao_editar = [];

if ($id_opiniao) {
    $opiniao_editar = $cms->getOpinion()->get($id_opiniao);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opiniao = $_POST['opinion'];

    $erros['opiniao'] = Validate::isText($opiniao, 1, 2000) ? '' : 'A tua opinião deve ter entre 1 e 200 caracteres. Também pode conter tags <b>, <i>, <a>, e <img>';

    $invalid = implode($erros);
    if (!$invalid) {
        $purifier = new HTMLPurifier();
        $purifier->config->set('HTML.Allowed', 'b,i,a[href],img[src|alt]');
        $opiniao = $purifier->purify($opiniao);

        if (!$id_opiniao) {
            $arguments = [$opiniao, $id, $session->id];
            $cms->getOpinion()->create($arguments);
            redirect('#');
        } else {
            $cms->getOpinion()->update($opiniao, $opiniao_editar['id']);
            redirect(DOC_ROOT . 'opinions/' . $opiniao_editar['receita_id']);
        }
    }
}

$data['opinioes'] = $opinioes;
$data['form_id'] = $form_id;
$data['opiniao_editar'] = $opiniao_editar;
$data['id_opiniao'] = $id_opiniao;
$data['autor_conteudo_id'] = $autor_conteudo_id;

echo $twig->render('opinions.html', $data);
