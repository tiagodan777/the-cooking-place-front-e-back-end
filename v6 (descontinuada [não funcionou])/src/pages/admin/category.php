<?php
use TiagoDaniel\Validate\Validate;

is_admin($cookie->role);

$categoria = [
    'id' => $id,
    'nome' => '',
    'descricao' => '',
];
$erros = [
    'warning' => '',
    'nome' => '',
    'descricao' => '',
];

if ($id) {
    $categoria = $cms->getCategory()->get($id);
    if (!$categoria) {
        redirect('categories.php', ['falha' => 'Categoria não encontrada']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria['nome'] = $_POST['nome'];
    $categoria['descricao'] = $_POST['descricao'];

    $erros['nome'] = Validate::isText($categoria['nome'], 1, 32) ? '' : 'O nome da categoria deve ter entre 1 e 32 caracteres';
    $erros['descricao'] = Validate::isText($categoria['descricao'], 1, 256) ? '' : 'A descrição da categoria deve ter entre 1 e 256 catacteres';

    $invalido = implode($erros);

    if ($invalido) {
        $erros['warning'] = 'Por favor corrige os erros';
    } else {
        $arguments = $categoria;
        if ($id) {
            $guardado = $cms->getCategory()->update($arguments);
        } else {
            unset($arguments['id']);
            $guardado = $cms->getCategory()->create($arguments);
        }

        if ($guardado) {
            redirect(DOC_ROOT . 'admin/categories/', ['success' => 'Categoria guardada']);
        } 
        else {
            $erros['warning'] = 'O nome "' . $arguments['nome'] . '"  já foi utilizado noutra categoria';
        }
    }
}

$membro = $cms->getMember()->get(1);

$data['categoria'] = $categoria;
$data['erros'] = $erros;
$data['membro'] = $membro;

echo $twig->render('admin/category.html', $data);
?>
