<?php
use TiagoDaniel\Validate\Validate;

require_login($cookie);

$errors = [];

$membro = $cms->getMember()->getFull($cms->getCookie()->id);

$data_nascimento = preg_split('/-/', $membro['nascimento']);
$dia = $data_nascimento[2];
$mes = $data_nascimento[1];
$ano = $data_nascimento[0];

$meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Sep', 'Out', 'Nov', 'Dez'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $membro['forename'] = $_POST['primeiro_nome'];
    $membro['surname'] = $_POST['ultimo_nome'];
    $membro['telefone'] = $_POST['telefone'];
    $membro['email'] = $_POST['email'];
    $membro['bio'] = $_POST['bio'];
    $membro['dia'] = $_POST['dia'];
    $membro['mes'] = $_POST['mes'];
    $membro['ano'] = $_POST['ano'];
    $membro['genero'] = $_POST['genero'];
    $membro['user_nick_name'] = create_seo_name(mb_strtolower($membro['forename']) . mb_strtolower($membro['surname']));


    $erros['forename'] = Validate::isText($membro['forename'], 1, 60) ? '' : 'O nome deve ter entre 1 e 60 caradteres';
    $erros['surname'] = Validate::isText($membro['surname'], 1, 60) ? '' : 'O nome deve ter entre 1 e 60 caradteres';
    $erros['telefone'] = Validate::isNumber($membro['telefone'], 900000000, 999999999) ? '' : 'O número de telefone deve ser entre 9000000 e 999999999';
    $erros['email'] = Validate::isEmail($membro['email']) ? '' : 'Introduz um email válido';
    $errors['bio'] = Validate::isText($membro['bio']) ? '' : 'A bio deve ter entre 0 e 64 caracteres';
    $erros['dia'] = Validate::isNumber($membro['dia'], 1, 31) ? '' : 'Escolhe um dia válido sua parva';
    $erros['mes'] = Validate::isNumber($membro['mes'], 1, 12)? '' : 'Escolhe um mês válido sua parva';
    $erros['ano'] = Validate::isNumber($membro['ano'], 1900, date('Y')) ? '' : 'Escolhe um ano válido sua parva';
    $erros['genero'] = Validate::isGenero($membro['genero'])? '' : 'Queres mais géneros para quê parvalhona?';

    $invalid = implode($errors);
    if (!$invalid) {
        $membro['nascimento'] = $membro['ano'] . '-' . $membro['mes'] . '-' . $membro['dia'];
        $result = $cms->getMember()->update($membro);

        if ($result == false) {
            $errors['email'] = 'O endereço de email já está a ser usado';
        } else {
            redirect('profile.php', ['id' => $membro['id'], 'message' => 'Alterações gravadas']);
        }
    }

}

$data['membro'] = $membro;
$data['dia'] = $dia;
$data['mes'] = $mes;
$data['ano'] = $ano;
$data['meses'] = $meses;

echo $twig->render('edit-profile.html', $data);