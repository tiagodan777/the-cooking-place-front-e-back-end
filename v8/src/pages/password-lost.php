<?php
use TiagoDaniel\Validate\Validate;

$sent = false;
$email = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $error = Validate::isEmail($email) ? '' : 'Por favor introudz um endereço de email válido';
    if ($error == '') {
        $id = $cms->getMember()->getIdByEmail($email);
        if ($id) {
            $token = $cms->getToken()->create($id, 'password_reset');
            $link = DOMAIN . DOC_ROOT . 'password-reset.php?token=' . $token;
            $subject = 'Link para reposição de password';
            $body = 'Para alterar a password clica em <a href="' . $link . '">' . $link . '</a>';
            $mail = new \TiagoDaniel\Email\Email($email_config);
            $sent = $mail->sendEmail($email_config['admin_email'], $email, $subject, $body);
        }
    }
}

$data['sent'] = $sent;
$data['error'] = $error;

echo $twig->render('password-lost.html', $data);

