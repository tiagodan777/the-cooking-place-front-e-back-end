<?php
use TiagoDaniel\Validate\Validate;

require_login($session);

$temp = $_FILES['imagem']['tmp_name'] ?? null;

$post = [
    'id' => $id,
    'imagem_file' => '',
    'descricao' => '',
    'membro_id' => $session->id,
];
$erros = [
    'warning' => '',
    'imagem_file' => '',
    'descricao' => '',
];
$path = APP_ROOT . '/public/posts/';

if ($id) {
    $post = $cms->getPost()->get($id);
    if (!$post) {
        redirect(DOC_ROOT . 'profile/', ['failure' => 'Publicação não encontrada']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($temp && $_FILES['imagem']['error'] == 0) {
        $erros['imagem_file'] = ($temp == '' && $_FILES['imagem']['error'] == 1)? 'Arquivo demasiado grande' : '';
        $erros['imagem_file'] .= $_FILES['imagem']['size'] <= MAX_SIZE ? '' : 'Arquivo demasiado grande';
        $erros['imagem_file'] .= in_array(mime_content_type($temp), MEDIA_TYPES) ? '' : 'Tipo de media ão suportada. São aceites arquivos do tipo [jpeg], [png] e [gif]';
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $erros['imagem_file'] .= in_array($ext, FILE_EXTENSIONS) ? '' : 'Extensão não suportada. São aceites arquivos .jpeg, .jpg, .png e .gif';

        if ($erros['imagem_file'] === '') {
            $post['imagem_file'] = create_filename($_FILES['imagem']['name'], $path);
            $destination = $path . $post['imagem_file'];
        }
    }

    $post['descricao'] = $_POST['descricao'];

    $erros['descricao'] = Validate::isText($post['descricao'], 0 , 2000) ? '' : 'A descrição deve ter entre 0 e 2000 caracteres';

    $invalid = implode($erros);
    if ($invalid) {
        $erros['warning'] = 'Por favor corrige os erros';
    } else {
        if (!$id) {
            unset($post['id']);
            $cms->getPost()->create($post, $temp, $destination);
            redirect(DOC_ROOT . 'profile/'  . $session->id . $session->seo_name, ['success' => 'Publicado com sucesso']);
        } else {
            unset($post['data']);
            unset($post['membro_id']);
            unset($post['autor']);
            unset($post['picture']);
            unset($post['likes']);
            unset($post['opinioes']);
            unset($post['imagem_file']);

            $cms->getPost()->update($post);
            redirect(DOC_ROOT . 'profile/' . $session->id . $session->seo_name , ['success' => 'Publicação editada com sucesso']);
        }
    }
}

$data['post'] = $post;

echo $twig->render('create-edit-post.html', $data);