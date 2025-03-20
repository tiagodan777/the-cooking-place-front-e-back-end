<?php
use TiagoDaniel\Validate\Validate;

require_once '../src/bootstrap.php';

$errors = [];

$token = $_GET['token'] ?? '';
if (!$token) {
    redirect('login.php');
}
$id = $cms->getToken()->getMemberId($token, 'password_reset');
if (!$id) {
    redirect('login.php', ['warning' => 'Link expirado. Tenta novamente']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $errors['password'] = Validate::isPassword($password) ? '' : 'A password deve ter pelo menos 8 caracteres, 1 caracter minúsculo, 1 maiúsculo e 1 número';
    $errors['confirm'] = ($password == $confirm) ? '' : 'As passwords não são iguais';
    $invalid = implode($errors);

    if ($invalid) {
        $errors['message'] = 'Por favor introduz uma password válida';
    } else {
        $cms->getMember()->passwordUpdate($id, $password);
        $member = $cms->getMember()->get($id);
        /*echo $id;
        echo "<pre>";
        var_dump($member);
        echo "</pre>";*/
        $subject = 'Reposição de Password';
        $body = 'A tua password foi reposta a ' . date('d F Y H:i:s') . ' - se não efetuas-te a reposição da password, envia um email para' . $email_config['admin_email'];
        $email = new \TiagoDaniel\Email\Email($email_config);
        $email->sendEmail($email_config['admin_email'], $member['email'], $subject, $body);
        redirect('login.php', ['success' => 'Password Alterada']);
    }
}

$data['token'] = $token;
$data['errors'] = $errors;

echo $twig->render('password-reset.html', $data);