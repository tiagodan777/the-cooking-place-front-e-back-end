<?php
require_once '../src/bootstrap.php';

require_login($cookie);

$id = $cookie->id;
$input_message = $_POST['message'] ?? '';

if (!$id) {
    redirect('index.php', ['failure' => 'Membro não encontrado']);
}

$membro = $cms->getMember()->getFull($id);

if ($_SERVER['REQUEST_METHOD']  == 'POST') {
    $email = $membro['email'];

    $token = $cms->getToken()->create($id, 'delete_account');
    $link = DOMAIN . DOC_ROOT . 'delete-account.php?token=' . $token;
    $subject = 'Deseja mesmo deixar o The Cooking Place?';
    $body = 'É uma pena ver-te a deixar a nossa plataforma. Se pretenderes seguir com a tua decisão, clica no link <a href="' . $link . '">' . $link . '</a> para que todos os teus dados e receitas sejam apagados.';
    $message = 'Foi-te enviado um email para confirmares a remoção da tua conta';
    $mail = new \TiagoDaniel\Email\Email($email_config);
    $mail->sendEmail($email_config['admin_email'], $email, $subject, $body);
}

$data['membro'] = $membro;
$data['message'] = $input_message;

echo $twig->render('profile-delete.html', $data);
?>
