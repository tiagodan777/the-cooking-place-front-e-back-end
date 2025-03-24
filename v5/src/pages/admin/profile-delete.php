<?php
is_admin($cookie->role);

$input_message = $_POST['message'] ?? '';

if (!$id) {
    redirect(DOC_ROOT . 'admin/index/', ['failure' => 'Membro não encontrado']);
}

$membro = $cms->getMember()->getFull($id);

if ($_SERVER['REQUEST_METHOD']  == 'POST') {
    $email = $membro['email'];

    $token = $cms->getToken()->create($id, 'delete_account');
    $link = DOMAIN . DOC_ROOT . 'admin/delete-account/?token=' . $token . '&id=' . $membro['id'];
    $subject = 'Deseja mesmo deixar o The Cooking Place?';
    $body = 'É uma pena ver-te a deixar a nossa plataforma. Se pretenderes seguir com a tua decisão, clica no link <a href="' . $link . '">' . $link . '</a> para que todos os teus dados e receitas sejam apagados.';
    $message = 'Foi-te enviado um email para confirmares a remoção da tua conta';
    $mail = new \TiagoDaniel\Email\Email($email_config);
    $mail->sendEmail($email_config['admin_email'], $email_config['admin_email'], $subject, $body);
}

$data['membro'] = $membro;
$data['message'] = $input_message;

echo $twig->render('admin/profile-delete.html', $data);
?>
