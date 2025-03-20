<?php
require_once '../src/bootstrap.php';

require_login($cookie);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$path = APP_ROOT . '/public/imagens/fotos-perfil/';
$delete = $_POST['delete'] ?? '';
/*$temp = $_FILES['picture']['tmp_name'] ?? '';*/
$erro_com_a_imagem = $_FILES['picture']['error'] ?? '';
$destination = '';
$erros = [];

if (!$id) {
    redirect('index.php', ['failure' => 'Membro não encontrado']);
}

$membro = $cms->getMember()->get($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($delete) {
        $apagar = $cms->getMember()->pictureDelete($id, $path);
        if (!$apagar) {
            redirect('edit-profile.php', ['message' => 'Não foi possível apagar a foto de perfil']);
        } else {
            setcookie('picture', 'blank.jpg', time() + 60 * 60 * 24 * 7, '/', '', false, true);
            redirect('edit-profile-picture.php', ['message' => 'Foto de perdil apagada']);
        }
    } else {
        $temp = $_FILES['picture']['tmp_name'] ?? '';
        $erros['picture'] = ($temp === '' && $erro_com_a_imagem === 1) ? 'Ficheiro demasiado grande' : '';
        if ($temp && $erro_com_a_imagem == 0) {
            var_dump($erro_com_a_imagem);
            var_dump($temp);
            $erros['picture'] .= in_array(mime_content_type($temp), MEDIA_TYPES) ? '' : 'Tipo de ficherio não permitido';
            $ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $erros['picture'] .= in_array($ext, FILE_EXTENSIONS) ? '' : 'Tipo de extensão não permitida';
            $erros['picture'] .= ($_FILES['picture']['size'] <= MAX_SIZE) ? '' : 'Ficherio demasiado grande';

            if ($erros['picture'] === '') {
                $picture = create_filename($_FILES['picture']['name'], $path);
                $destination = $path . $picture;
                $membro['picture'] = $picture;
                $cms->getMember()->pictureCreate($membro, $temp, $destination);
                setcookie('picture', $picture, time() + 60 * 60 * 24 * 7, '/', '', false, true);
                redirect('edit-profile.php', ['message' => 'Foto de perfil alterada']);
            }
        } else {
            echo $erro_com_a_imagem;
        }
    }
}

$data['membro'] = $membro;

echo $twig->render('edit-profile-picture.html', $data);
?>
