 <?php
use TiagoDaniel\Validate\Validate;

$user = '';
$errors = [];
$success = $_GET['success'] ?? '';

$logged_in = $_SESSION['id'] ?? 0;

if ($logged_in != 0) {
    redirect(DOC_ROOT . 'index');
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
            $token = $cms->getCookie()->create($member);
            $cms->getSession()->create($token);

            $tokenLogin = $cms->getToken()->create($member['id'], 'login');
            // $cms->getSession()->create($tokenLogin, 'login');

            redirect(DOC_ROOT . 'index/?loginToken=' . $tokenLogin);
        } else {
            $errors['message'] = 'Por favor tenta novamente';
        }
    }
}

$data['user'] = $user;
$data['erros'] = $errors;
$data['success'] = $success;

echo $twig->render('login.html', $data);

