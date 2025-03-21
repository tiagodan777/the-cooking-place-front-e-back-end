<?php
use TiagoDaniel\Validate\Validate;

$from = '';
$message = '';
$success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from = $_POST['email'];
    $message = $_POST['message'];

    $errors['from'] = Validate::isEmail($from) ? '' : 'O email não é válido';
    $errors['message'] = Validate::isText($message) ? '' : 'A mensagem deve ter até 1000 caracteres';

    $invalid =  implode($errors);
    if ($invalid) {
        $errors['warning'] = 'Por favor corrige os erros';
    } else {
        $subject = 'Mensagem de contato por forlulário de ' . $from;
        $email = new \TiagoDaniel\Email\Email($email_config);
        $email->sendEmail($email_config['admin_email'], $email_config['admin_email'], $subject, $message);
        $success = 'A tua mensagem foi enviada! Obrigado.';
    }
}

$membro = $cms->getMember()->get(1);

$data['from'] = $from;
$datas['message'] = $message;
$data['erros'] = $errors;
$data['membro'] = $membro;

echo $twig->render('contact.html', $data);