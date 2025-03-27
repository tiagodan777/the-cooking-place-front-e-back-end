 <?php
use TiagoDaniel\Validate\Validate;

$user = '';
$errors = [];
$success = $_GET['success'] ?? '';

$logged_in = $_COOKIE['id'] ?? 0;

if ($logged_in != 0) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $passowrd = $_POST['password'];
    /*$errors['user'] = Validate::isEmail($user) ? '' : 'Por favor introduz um email/nº de telefone correto';*/
    $errors['password'] = Validate::isPassword($passowrd) ? '' : 'Por favor introduz uma password válida';

    $invalid = implode($errors);
    if (!$invalid) {
        $member = $cms->getMember()->login($user, $passowrd);
        if ($member && $member['role'] == 'suspended') {
            $errors['message'] = 'Conta suspensa';
        } elseif ($member) {
            $cms->getCookie()->create($member);
            redirect('index');
        } else {
            $errors['message'] = 'Por favor tenta novamente';
        }
    }
}

$data['user'] = $user;
$data['erros'] = $errors;
$data['success'] = $success;

echo $twig->render('login.html', $data);
