<?php
use TiagoDaniel\Validate\Validate;

require_login($cookie);

$unidades_tempo = ['min', 'hr'];

$temp = $_FILES['imagem']['tmp_name'] ?? '';
$erro_com_a_imagem = $_FILES['imagem']['error'] ?? '';
$destination = '';
$ingredientes = [];
$quantidades = [];
$passos_preparacao = [];
$keywords = [];

$receita = [
    'id' => $id,
    'titulo' => '',
    'descricao' => '',
    'tempo_preparo' => '',
    'unidade_tempo' => '',
    'numero_pessoas' => '',
    'ingredientes' => '',
    'quantidades' => '',
    'passos_preparacao' => '',
    'keywords' => '',
    'imagem_file' => '',
    'categoria_id' => 0,
    'membro_id' => 0,
];
$erros = [
    'warning' => '',
    'titulo' => '',
    'descricao' => '',
    'tempo_preparo' => '',
    'unidade_tempo' => '',
    'numero_pessoas' => '',
    'ingredientes' => '',
    'quantidades' => '',
    'passos_preparacao' => '',
    'keywords' => '',
    'imagem_file' => '',
    'categoria_id' => '',
    'membro_id' => '',
];

if ($id) {
    $receita = $cms->getArticle()->get($id);
    if (!$receita) {
        redirect(DOC_ROOT . 'profile/' . $id, ['failure' => 'Receita não encontrada']);
    }
}

$saved_image = $receita['imagem_file'] ? true : false;

$categorias = $cms->getCategory()->getAll();

/*$autores = $cms->getMember()->getAll();*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $erros['imagem_file'] = ($temp === '' && $erro_com_a_imagem === 1) ? 'Ficheiro demasiado grande' : '';

    if ($temp && $_FILES['imagem']['error'] === 0) {
        $erros['imagem_file'] .= in_array(mime_content_type($temp), MEDIA_TYPES) ? '' : 'Tipo de ficherio não permitido';
        $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $erros['imagem_file'] .= in_array($ext, FILE_EXTENSIONS) ? '' : 'Tipo de extensão não permitida';
        $erros['imagem_file'] .= ($_FILES['imagem']['size'] <= MAX_SIZE) ? '' : 'Ficherio demasiado grande';

        if ($erros['imagem_file'] === '') {
            $receita['imagem_file'] = create_filename($_FILES['imagem']['name'], UPLOADS);
            $destination = UPLOADS . $receita['imagem_file'];
        }
    }

    $receita['titulo'] = $_POST['titulo'];
    $receita['descricao'] = $_POST['descricao'];
    $receita['tempo_preparo'] = $_POST['tempo_preparo'];
    $receita['unidade_tempo'] = $_POST['unidade_tempo'];
    $receita['numero_pessoas'] = $_POST['numero_pessoas'];

    $quant_ingredientes = $_POST['quant_ingredientes'];
    $quant_quantidades = $_POST['quant_quantidades'];
    $quant_passos_preparacao = $_POST['quant_passos_preparacao'];
    $quant_keywords = $_POST['quant_keywords'];

    for ($c = 1; $c <= $quant_ingredientes; $c++) {
        $ingredientes[] = $_POST["ingredientes$c"];
    }

    for ($c = 1; $c <= $quant_quantidades; $c++) {
        $quantidades[] = $_POST["quantidades$c"];
    }

    for ($c = 1; $c <= $quant_passos_preparacao; $c++) {
        $passos_preparacao[] .= $_POST["passo$c"];
    }

    for ($c = 1; $c <= $quant_keywords; $c++) {
        $keywords[] = preg_replace('/#/', '', $_POST["tag$c"]);
    }

    $receita['ingredientes'] = implode(',', $ingredientes);
    $receita['quantidades'] = implode(',', $quantidades);
    $receita['passos_preparacao'] = implode('#', $passos_preparacao);
    $receita['keywords'] = implode('#', $keywords);
    $receita['membro_id'] = $_POST['membro_id'];
    $receita['categoria_id'] = $_POST['categoria_id'];
    $receita['seo_title'] = create_seo_name($receita['titulo']);

    $purifier = new HTMLPurifier();
    $purifier->config->set('HTML.Allowed', 'p,br,strong,em,a[href],img[src|alt]');
    $receita['passos_preparacao'] = $purifier->purify($receita['passos_preparacao']);

    /*foreach ($autores as $autor) {
        if ($receita['membro_id'] == $autor['id']) {
            $autor = $autor['nome'];
        }
    }*/

    $erros['titulo'] = Validate::isText($receita['titulo'], 1, 64) ? '' : 'O título deve ter entre 1 e 64 caracteres';
    $erros['descricao'] = Validate::isText($receita['descricao'], 1, 256) ? '' : 'A descrição deve ter entre 1 e 256 caracteres';
    $erros['tempo_preparo'] = Validate::isNumber($receita['tempo_preparo'], 0, 360) ? '' : 'O tempo de preparo deve ser entre 1 e 360';
    $erros['unidade_tempo'] = in_array($receita['unidade_tempo'], $unidades_tempo) ? '' : 'A unidade de tempo deve ser minutos ou horas';
    $erros['numero_pessoas'] = Validate::isNumber($receita['numero_pessoas'], 0, 16) ? '' : 'O número de pessoas deve ser entre 1 e 16';
    $erros['ingredientes'] = Validate::isText($receita['ingredientes'], 0, 1024) ? '' : 'A soma de todos os caracteres de todos os ingredientes não deve ser maior que 1024';
    $erros['quantidades'] = Validate::isText($receita['quantidades'], 0, 1024) ? '' : 'A soma de todos os caracteres de todas as quantiades não deve ser maior que 1024';
    $erros['passos_preparacao'] = Validate::isText($receita['passos_preparacao'], 0, 65244) ? '' : 'A soma de todos oscaracteres de todos os passos de preparação não deve ser maior que 65244';
    $erros['keywords'] = Validate::isText($receita['keywords'], 0, 1024) ? '' : 'A soma de todos os caracteres de todas as keywords não deve ser maior que 1024';
    $erros['categoria_id'] = Validate::isCategoryId($receita['categoria_id'], $categorias) ? '' : 'A categoria selectionada não é válida';
    /*$erros['membro_id'] = Validate::isMemberId($receita['membro_id'], $autores);*/

    $invalid = implode($erros);

    if ($invalid) {
        $erros['warning'] = 'Por favor corrige os error seguintes';
    } else {
        $arguments = $receita;
        if ($id) {
            unset($arguments['data']);
            unset($arguments['nome']);
            unset($arguments['autor']);
            unset($arguments['picture']);
            unset($arguments['video_file']);
            unset($arguments['id_membro']);
            unset($arguments['seo_member']);
            unset($arguments['likes']);
            unset($arguments['opinioes']);
            unset($arguments['video_longo_file']);
            unset($arguments['quik_file']);
            echo "<pre>";
            var_dump($arguments);
            echo "</pre>";
            $guardada = $cms->getArticle()->update($arguments, $temp, $destination);
        } else {
            unset($arguments['id']);
            unset($arguments['data']);
            unset($arguments['nome']);
            unset($arguments['autor']);
            unset($arguments['picture']);
            unset($arguments['video_file']);
            unset($arguments['id_membro']);
            unset($arguments['seo_member']);
            unset($arguments['likes']);
            unset($arguments['opinioes']);
            echo "<pre>";
            var_dump($arguments);
            echo "</pre>";
            $guardada = $cms->getArticle()->create($arguments, $temp, $destination);
        }
        redirect(DOC_ROOT . 'profile/' . $receita['membro_id'] . '/', ['success' => 'Artigo guardado']);  
    }
    $receita['imagem_file'] = $saved_image ? $receita['imagem_file'] : '';
}

$data['receita'] = $receita;
$data['erros'] = $erros;
$data['categorias'] = $categorias;
/*$data['autores'] = $autores;
$data['autor'] = $autor;*/
$data['ingredientes'] = explode(',', $receita['ingredientes']);
$data['count_ingredientes'] = count($data['ingredientes']);
$data['quantidades'] = explode(',', $receita['quantidades']);
$data['passos_preparacao'] = explode('#', $receita['passos_preparacao']);
$data['count_passos_preparacao'] = count($data['passos_preparacao']);
$data['keywords'] = explode('#', $receita['keywords']);
$data['count_keywords'] = count($data['keywords']);


echo $twig->render('create-edit-article.html', $data);
?>
