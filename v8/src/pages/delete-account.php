<?php
require_login($cookie);

$id = $cookie->id;
if (!$id) {
    redirect(DOC_ROOT . 'index/', ['failure' => 'Membro não encontrado']);
}

$membro = $cms->getMember()->getFull($id);

if ($_SERVER['REQUEST_METHOD']  == 'POST') {
    $email = $membro['email'];

    $token = $cms->getToken()->create($id, 'delete_account');
    $subject = 'Apagou definitivamente a sua conta em thecookingplace.com';
    $body = 'É uma pena ver-te a deixar a nossa plataforma. Obrigado por todas as receitas e pratos que partilhas-te connosco';
    $mail = new \TiagoDaniel\Email\Email($email_config);
    $mail->sendEmail($email_config['admin_email'], $email, $subject, $body);

    $delete = $cms->getMember()->delete($membro);

    if ($delete) {
        redirect(DOC_ROOT . 'profile/', ['message' => 'Não foi possível apagar a tua conta. Tenta mais tarde']);
    } else {
        $cms->getCookie()->delete();
        redirect(DOC_ROOT . 'register/');
    }
}

$data['membro'] = $membro;

echo $twig->render('delete-account.html', $data);
?>
