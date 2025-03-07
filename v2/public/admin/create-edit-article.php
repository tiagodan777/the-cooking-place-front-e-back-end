<?php
require_once '../../src/bootstrap.php';

$unidades_tempo = ['min', 'hr'];

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$temp = $_FILES['imagem']['tmp_name'] ?? '';
$erro_com_a_imagem = $_FILES['imagem']['error'] ?? '';
$destination = '';
$autor = '';

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
        redirect('articles.php', ['failure' => 'Receita não encontrada']);
    }
}

$saved_image = $receita['imagem_file'] ? true : false;

$categorias = $cms->getCategory()->getAll();

$autores = $cms->getMember()->getAll();

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
    $receita['ingredientes'] = $_POST['ingredientes'];
    $receita['quantidades'] = $_POST['quantidades'];
    $receita['passos_preparacao'] = $_POST['passos_preparacao'];
    $receita['keywords'] = $_POST['keywords'];
    $receita['membro_id'] = $_POST['membro_id'];
    $receita['categoria_id'] = $_POST['categoria_id'];

    foreach ($autores as $autor) {
        if ($receita['membro_id'] == $autor['id']) {
            $autor = $autor['nome'];
        }
    }

    $erros['titulo'] = Validate::isText($receita['titulo'], 1, 64) ? '' : 'O título deve ter entre 1 e 64 caracteres';
    $erros['descricao'] = Validate::isText($receita['descricao'], 1, 256) ? '' : 'A descrição deve ter entre 1 e 256 caracteres';
    $erros['tempo_preparo'] = Validate::isNumber($receita['tempo_preparo'], 0, 60) ? '' : 'O tempo de preparo deve ser entre 1 e 60';
    $erros['unidade_tempo'] = in_array($receita['unidade_tempo'], $unidades_tempo) ? '' : 'A unidade de tempo deve ser minutos ou horas';
    $erros['numero_pessoas'] = Validate::isNumber($receita['numero_pessoas'], 0, 16) ? '' : 'O número de pessoas deve ser entre 1 e 16';
    $erros['ingredientes'] = Validate::isText($receita['ingredientes'], 0, 1024) ? '' : 'A soma de todos os caracteres de todos os ingredientes não deve ser maior que 1024';
    $erros['quantidades'] = Validate::isText($receita['quantidades'], 0, 1024) ? '' : 'A soma de todos os caracteres de todas as quantiades não deve ser maior que 1024';
    $erros['passos_preparacao'] = Validate::isText($receita['passos_preparacao'], 0, 65244) ? '' : 'A soma de todos oscaracteres de todos os passos de preparação não deve ser maior que 65244';
    $erros['keywords'] = Validate::isText($receita['keywords'], 0, 1024) ? '' : 'A soma de todos os caracteres de todas as keywords não deve ser mairo que 1024';
    $erros['categoria_id'] = Validate::isCategoryId($receita['categoria_id'], $categorias) ? '' : 'A categoria selectionada não é válida';
    $erros['membro_id'] = Validate::isMemberId($receita['membro_id'], $autores);

    $invalid = implode($erros);

    if ($invalid) {
        $erros['warning'] = 'Por favor corrige os error seguintes';
    } else {
        $arguments = $receita;
        if ($id) {
            unset($arguments['imagem_alt_text']);
            unset($arguments['data']);
            unset($arguments['nome']);
            unset($arguments['autor']);
            unset($arguments['picture']);
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
            $guardada = $cms->getArticle()->create($arguments, $temp, $destination);
        }
        redirect('articles.php', ['success' => 'Artigo guardado']);  
    }
    $receita['imagem_file'] = $saved_image ? $receita['imagem_file'] : '';
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Cooking Place</title>
    <link rel="shortcut icon" href="../imagens/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/desktop.css" media="screen and (min-width: 900px)">
    <link rel="stylesheet" href="../estilos/create-edit-article.css">
    <link rel="stylesheet" href="../estilos/create-edit-article-desktop.css" media="screen and (min-width: 900px)">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <style>
        main > form > section#imagem-video > div#div-imagem, main > form > section#imagem-video > div#div-video {
            border: <?= ($receita['imagem_file'] != '') ? 'none' : '1px solid rgb(210, 210, 210)' ?>;
        }

        main > form > section#imagem-video > div#div-imagem > label, main > form > section#imagem-video > div#div-video > label {
            text-indent: <?= ($receita['imagem_file'] != '') ? '-225px' : '0px' ?>;
        }
    </style>
</head>
<body>
    <header id="cabecalho-principal">
        <h1>
            <a href="index.php">
                <picture>
                    <source media="(max-width: 600px)" srcset="../imagens/logos/logo-pp.png">
                    <img src="../imagens/logos/logo-p.png" alt="Logo do The Cooking Place">
                </picture>
            </a>
        </h1>
        <form action="../search.php" method="get">
            <input type="search" name="search" id="search" placeholder="Pesquisa">
            <input type="submit" value="Pesquisar" class="escondido">
        </form>
        <div>
            <a href="../create-edit-article.html"><span class="material-symbols-outlined">add_box</span></a>
            <a href="../profile.html"><span class="material-symbols-outlined">account_circle</span></a>
        </div>
    </header>
    <br>

    <main id="principal">
        <h2>Adicionar/Editar Receita</h2>
        <?php if ($erros['warning']) { ?>
            <div class="alert-danger"><?= $erros['warning'] ?></div>
        <?php } ?>
        <form action="create-edit-article.php?id=<?= $id ?>" method="post" autocomplete="off" id="form" enctype="multipart/form-data">
            <section id="imagem-video">
                <div id="div-imagem">
                    <?php if (!$receita['imagem_file']) { ?>
                        <label for="imagem">Upload de imagem</label>
                        <div>
                            <input type="file" name="imagem" id="imagem" accept="image/jpeg, image/png, image/gif">
                        </div>
                        <span class="error"><?= $erros['imagem_file'] ?></span>
                    <?php } else { ?>
                        <label for="imagem_guardada">Imagem:</label>  
                        <img src="../imagens/comida/<?= html_escape($receita['imagem_file']) ?>" alt="Foto de <?= html_escape($receita['titulo']) ?> publicada por <?= $autor ?>" id="imagem_guardada">
                        <br>
                        <a href="image-delete.php?id=<?= $id ?>">Apagar imagem</a>
                    <?php } ?>
                </div>
                <div id="div-video">
                    <label for="video">Upload de video</label>
                    <div>
                        <input type="file" name="video" id="video" readonly>
                    </div>
                </div>
                <div id="inputs-escondidos">
                    <input type="text" name="ingredientes" id="ingredientes" value="<?= html_escape($receita['ingredientes']) ?>">
                    <input type="text" name="quantidades" id="quantidades" value="<?= html_escape($receita['quantidades']) ?>">
                    <input type="text" name="passos_preparacao" id="passos_preparacao" value="<?= html_escape($receita['passos_preparacao']) ?>">
                    <input type="text" name="keywords" id="keywords" value="<?= html_escape($receita['keywords']) ?>">
                </div>
            </section>
            <section id="info-text">
                <div id="div-titulo">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Ex: Sushi" required maxlength="64" value="<?= html_escape($receita['titulo']) ?>">
                    <span class="error"><?= $erros['titulo'] ?></span>
                </div>
                <div id="div-descricao">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" placeholder="Ex: Como fazer sushi de forma rápida e descomplicada" maxlength="256" required value="<?= html_escape($receita['descricao']) ?>">
                    <span class="error"><?= $erros['descricao'] ?></span>
                </div>
                <div id="div-tempo-preparo">
                    <label for="tempo">Tempo de preparo</label>
                    <div id="tempo-unidade">
                        <input type="number" name="tempo_preparo" id="tempo_preparo" placeholder="Ex: 45" min="0" value="<?= html_escape($receita['tempo_preparo']) ?>">
                        <span class="error"><?= $erros['tempo_preparo'] ?></span>
                        <select name="unidade_tempo" id="unidade_tempo">
                            <optgroup label="Unidade">
                                <option value="min" <?= ($receita['unidade_tempo'] == 'min') ? 'selected' : '' ?>>Min</option>
                                <option value="hr" <?= ($receita['unidade_tempo'] == 'hr') ? 'selected' : ''?>>Hora</option>
                            </optgroup>
                        </select>
                        <span class="error"><?= $erros['unidade_tempo'] ?></span>
                    </div>
                </div>
                <div id="numero-pessoas">
                    <label for="numero-pessoas">Nº de Pessoas</label>
                    <select name="numero_pessoas" id="numero-pessoas">
                        <?php for ($i = 1; $i <= 16; $i++) { ?>
                            <option value="<?= $i ?>" <?= ($receita['numero_pessoas'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
                        <?php } ?>
                    </select>
                    <span class="error"><?= $erros['numero_pessoas'] ?></span>
                </div>
                <div id="div-categorias">
                    <label for="categoria_id">Categoria</label>
                    <select name="categoria_id" id="categoria_id">
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $receita['categoria_id']) ? 'selected' : '' ?>><?= html_escape($categoria['nome']) ?></option>
                        <?php } ?>
                    </select>
                    <span class="error"><?= $erros['categoria_id'] ?></span>
                    <label for="membro_id">Membro</label>
                    <select name="membro_id" id="membros_id">
                        <?php foreach ($autores as $autor) { ?>
                            <option value="<?= $autor['id'] ?>" <?= ($autor['id'] == $receita['membro_id']) ? 'selected' : '' ?>><?= html_escape($autor['nome']) ?></option>
                        <?php } ?>
                    </select>
                    <span class="error"><?= $erros['membro_id'] ?></span>
                </div>
                <div id="div-ingredientes">
                    <div id="labels-ingredientes-quantidade">
                        <label for="ingredientes">Ingredientes</label>
                        <label for="quantidade">Quantidade</label>
                    </div>
                    <div class="ingredientes-quantidade">
                        <?php 
                            $ingredientes = explode(',', $receita['ingredientes']);
                            $quantiades = explode(',', $receita['quantidades']);
                            for ($i = 1; $i <= count($ingredientes); $i++) { ?>
                                <div class="inputs-ingredientes-quantidade">
                                    <input type="text" name="ingredientes<?= $i ?>" id="ingredientes<?= $i ?>" placeholder="Ex: Salmão" minlength="1" maxlength="32" value="<?= html_escape($ingredientes[$i-1]) ?>">
                                    <span class="error"><?= $erros['ingredientes'] ?></span>
                                    <input type="text" name="quantidades<?= $i ?>" id="quantidades<?= $i ?>" placeholder="Ex: 3; 450g; 100ml..." value="<?= html_escape($quantiades[$i-1]) ?>">
                                    <span class="error"><?= $erros['quantidades'] ?></span>
                                </div>
                        <?php } ?>
                    </div>
                    <input type="button" value="Adicionar Ingrediente" onclick="adicionaIngredienteEQuantidade()">
                </div>
                <div id="div-passos-preparacao">
                    <label for="div-passos-preparacao">Passos para a Preparação</label>
                    <div id="div-textareas">
                        <?php
                            $passos_preparacao = explode('#', $receita['passos_preparacao']);
                            $i = 1;
                            foreach ($passos_preparacao as $passo) {?>
                                <div class="textarea">
                                    <label for="passo<?= $i ?>">Passo <?= $i ?></label>
                                    <textarea name="passo<?= $i ?>" id="passo<?= $i ?>" cols="40" rows="7"><?= html_escape($passo) ?></textarea>
                                    <span class="error"><?= $erros['passos_preparacao'] ?></span>
                                </div>
                        <?php
                            $i++;
                        } ?>
                    </div>
                    <input type="button" value="Adicionar Passo" onclick="adicionaPasso()">
                </div>
                <div id="div-keywords-tags-e-section-actions">
                    <div id="div-tags">
                        <label for="tag1">Keywords / Tags</label>
                        <?php
                            $keywords = explode('#', $receita['keywords']);
                            $i = 1;
                            foreach ($keywords as $keyword) {
                        ?>
                                <div class="tags">
                                    <label for="tag<?= $i ?>">Tag <?= $i ?></label>
                                    <input type="text" name="tag<?= $i ?>" id="tag<?= $i ?>" placeholder="Ex: #sushi" value="<?= html_escape($keyword) ?>">
                                    <span class="error"><?= $erros['keywords'] ?></span>
                                </div>
                        <?php } ?>
                    </div>
                    <input type="button" value="Adicionar Tag" onclick="adicionaTag()">
                    <section id="actions">
                        <a href="article-delete.html">Apagar</a>
                        <input type="submit" value="Publicar Receita" onclick="adicionaIngredienteEQuantidade(true), adicionaPasso(true), adicionaTag(true)">
                    </section>
                </div>
            </section>
        </form>
    </main>
    <footer>
        <a href="../pagina-principal.html"><span class="material-symbols-outlined aparece-desktop">home</span> <span class="descricao-icone">Página Principal</span></a>
        <a href="../notifications.html"><span class="material-symbols-outlined aparece-desktop">favorite</span> <span class="descricao-icone nao-destaque">Notificações</span></a>
        <a href="../all-messages.html"><span class="material-symbols-outlined">send</span> <span class="descricao-icone nao-destaque">Mensagens</span></a>
        <a href="../whats-happening.html"><span class="material-symbols-outlined aparece-desktop">star</span> <span class="descricao-icone nao-destaque">O que está a acontecer?</span></a>
        <a href="../profile.html"><span class="material-symbols-outlined aparece-desktop">account_circle</span> <span class="descricao-icone nao-destaque">Perfil</span></a>
        <a href="../create-edit-article.html"><span class="material-symbols-outlined aparece-mobile">add_box</span></a>
        <a href="#"><span class="material-symbols-outlined aparece-mobile">search</span></a>
    </footer>
    <script>
        let idNameIgrediente = 2
        let idNamePasso = 2
        let idNameTag = 2
        function adicionaIngredienteEQuantidade(ultimo = false) {
            let inputText = window.document.createElement('input')
            let inputNumber = window.document.createElement('input')
            let div = window.document.createElement('div')
            let ingredientes = window.document.querySelector('div.ingredientes-quantidade')
            let divIngredientes = window.document.querySelector('div#div-ingredientes')
            let inputHiddenIngredientes = window.document.querySelector('input#ingredientes')
            let inputHiddenQuantidades = window.document.querySelector('input#quantidades')
            let idNameIgredienteAnterior = idNameIgrediente - 1
            let inputAnteriorIngredientes = window.document.querySelector(`input#ingredientes${idNameIgredienteAnterior}`)
            let inputAnteriorQuantidades = window.document.querySelector(`input#quantidades${idNameIgredienteAnterior}`)
            let form = window.document.querySelector('form#form')

            inputText.type = 'text'
            inputText.name = `ingredientes${idNameIgrediente}`
            inputText.id = `ingredientes${idNameIgrediente}`
            inputText.required = false
            inputText.minLength = 1
            inputText.maxLength = 32

            inputNumber.type = 'text'
            inputNumber.name = `quantidades${idNameIgrediente}`
            inputNumber.id = `quantidades${idNameIgrediente}`
            inputNumber.required = false

            div.className = 'inputs-ingredientes-quantidade'

            if (!ultimo) {
                inputHiddenIngredientes.value += `${inputAnteriorIngredientes.value}, `
                inputHiddenQuantidades.value += `${inputAnteriorQuantidades.value}, `
            } else {
                let inputAtualQuantidades = window.document.querySelector(`input#quantidades${idNameIgredienteAnterior}`)
                let inputAtualIngredientes = window.document.querySelector(`input#ingredientes${idNameIgredienteAnterior}`)
                inputHiddenIngredientes.value += `${inputAtualIngredientes.value}`
                inputHiddenQuantidades.value += `${inputAtualQuantidades.value}`
            }
            
            /*divIngredientes.style.border = '2px solid red'*/
            //divIngredientes.style.height += '300px'
            //main.style.height = Number(alturaMain)
            //form.style.height = Number(form.offsetHeight) + Number(200)


            div.appendChild(inputText)
            div.appendChild(inputNumber)
            ingredientes.appendChild(div)
            idNameIgrediente++

        }
        
        function adicionaPasso(ultimo = false) {
            let label = window.document.createElement('label')
            let textArea = window.document.createElement('textarea')
            let div = window.document.createElement('div')
            let divTextAreas = window.document.querySelector('div#div-textareas')
            let inputHiddenPassosPreparacao = window.document.querySelector('input#passos_preparacao')
            let idNamePassoAnterior = idNamePasso - 1
            let inputAnteriorPasso = window.document.querySelector(`textarea#passo${idNamePassoAnterior}`)

            label.setAttribute("for", `passo${idNamePasso}`)
            label.innerHTML = `Passo ${idNamePasso}`
            textArea.name = `passo${idNamePasso}`
            textArea.id = `passo${idNamePasso}`
            textArea.cols = 40
            textArea.rows = 7

            div.className = 'textarea'

            if (!ultimo) {
                if (idNamePasso == 2) {
                    inputHiddenPassosPreparacao.value += `${inputAnteriorPasso.value}`
                } else {
                    inputHiddenPassosPreparacao.value += `#${inputAnteriorPasso.value}`
                }
            } else {
                let inputAtualPasso = window.document.querySelector(`textarea#passo${idNamePassoAnterior}`)
                if (idNamePasso == 2) {
                    inputHiddenPassosPreparacao.value += `${inputAtualPasso.value}`
                } else {
                    inputHiddenPassosPreparacao.value += `#${inputAtualPasso.value}`
                }
            }

            div.appendChild(label)
            div.appendChild(textArea)
            divTextAreas.appendChild(div)

            idNamePasso++
        }

        function adicionaTag(ultimo = false) {
            let label = window.document.createElement('label')
            let input = window.document.createElement('input')
            let div = window.document.createElement('div')
            let divTags = window.document.querySelector('div#div-tags')
            let inputHiddenKeywords = window.document.querySelector('input#keywords')
            let idNameTagAnterior = idNameTag - 1
            let inputAnteriorTag = window.document.querySelector(`input#tag${idNameTagAnterior}`)

            label.setAttribute("for", `tag${idNameTag}`)
            label.innerHTML = `Tag ${idNameTag}`
            input.name = `tag${idNameTag}`
            input.id = `tag${idNameTag}`

            div.className = 'tags'

            if (!ultimo) {
                inputHiddenKeywords.value += `${inputAnteriorTag.value}, `
            } else {
                let inputAtualTag = window.document.querySelector(`input#tag${idNameTagAnterior}`)
                inputHiddenKeywords.value += `${inputAtualTag.value}`
            }

            div.appendChild(label)
            div.appendChild(input)
            divTags.appendChild(div)

            idNameTag++
        }
    </script>
</body>
</html>