<?php

use TiagoDaniel\Validate\Validate;

$membro = [];
$erros = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $membro['primeiro_nome'] = $_POST['primeiro_nome'];
    $membro['ultimo_nome'] = $_POST['ultimo_nome'];
    $membro['telemovel'] = $_POST['telemovel'];
    $membro['email'] = $_POST['email'];
    $membro['dia'] = $_POST['dia'];
    $membro['mes'] = $_POST['mes'];
    $membro['ano'] = $_POST['ano'];
    $membro['genero'] = $_POST['genero'];
    $membro['password'] = $_POST['password'];
    $confirmacao = $_POST['confirmacao'];

    $erros['primeiro_nome'] = Validate::isText($membro['primeiro_nome'], 1, 60) ? '' : 'O nome deve ter entre 1 e 60 caradteres';
    $erros['ultimo_nome'] = Validate::isText($membro['ultimo_nome'], 1, 60) ? '' : 'O nome deve ter entre 1 e 60 caradteres';
    $erros['telemovel'] = Validate::isNumber($membro['telemovel'], 900000000, 999999999) ? '' : 'O número de telefone deve ser entre 9000000 e 999999999';
    $erros['email'] = Validate::isEmail($membro['email']) ? '' : 'Introduz um email válido';
    $erros['dia'] = Validate::isNumber($membro['dia'], 1, 31) ? '' : 'Escolhe um dia válido sua parva';
    $erros['mes'] = Validate::isNumber($membro['mes'], 1, 12)? '' : 'Escolhe um mês válido sua parva';
    $erros['ano'] = Validate::isNumber($membro['ano'], 1900, date('Y')) ? '' : 'Escolhe um ano válido sua parva';
    $erros['genero'] = Validate::isGenero($membro['genero'])? '' : 'Queres mais géneros para quê parvalhona?';
    $erros['password'] = Validate::isPassword($membro['password']) ? '' : 'A password deve ter pelo menos 8 caracteres, 1 caracter minúsculo, 1 maiúsculo e 1 número';
    $erros['confirmacao'] = ($membro['password'] == $confirmacao) ? '' : 'As passwords não são idênticas';

    $invalid = implode($erros);
    if (!$invalid) {
        $membro['nascimento'] = $membro['ano'] . '-' . $membro['mes'] . '-' . $membro['dia'];
        $membro['user_nick_name'] = strtolower($membro['primeiro_nome']) . strtolower($membro['ultimonome']);
        $result = $cms->getMember()->create($membro);

        if ($result === false) {
            $erros['email'] = 'O email já está a ser usado';
        } else {
            redirect('login.php', ['success' => 'Obrigado por te registares. Faz log in!']);
        }
    }
}

$data['membro'] = $membro;
$data['error'] = $erros;

echo $twig->render('register.html', $data);