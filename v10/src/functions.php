<?php
/*function postado_ha_x_horas($receitas) {
    $novas_datas = [];

    foreach ($receitas as $receita) {
        $idade = time() - 3600 - strtotime($receita['data']); // Correção no cálculo da idade

        if ($idade < 60) {
            $data_formatda = 'Há ' . $idade . ' segundos';
        } elseif ($idade < 3600) {
            $data_formatda = 'Há ' . floor($idade / 60) . ' minutos';
        } elseif ($idade < 86400) {
            $data_formatda = 'Há ' . floor($idade / 3600) . ' horas';
        } elseif ($idade < 604800) {
            $data_formatda = 'Há ' . floor($idade / 86400) . ' dias';
        } else {
            $data_formatda = date('j F Y', strtotime($receita['data'])); // Exibir data original
        }

        $novas_datas[] = $data_formatda;
    }  

    return $novas_datas;  
}*/

function redirect($location, $parameters = [], $response_code = 302) {
    $qs = $parameters ? '?' . http_build_query($parameters) : '';
    $location = $location . $qs;
    header('Location: ' . $location, $response_code);
    exit;
}

function create_filename($basename, $upload_path) {
    $filename = pathinfo($basename, PATHINFO_FILENAME);
    $extention = pathinfo($basename, PATHINFO_EXTENSION);
    preg_replace('[^A-z0-9]', '-', $basename);

    $i = 1;
    while (file_exists($upload_path . $basename)) {
        $basename = $filename . $i . '.' . $extention;
        $i++;
    }
    return $basename;
}

function is_admin($role) {
    if ($role !== 'imperador_supremo_do_universo') {
        header('Location: ' . DOC_ROOT);
        exit;
    }
}

function require_login($session) {
    if ($session->id == 0) {
        redirect(DOC_ROOT . 'login/', ['failure' => 'Tens de fazer login para ter acesso a essa funcionalidade']);
    }
}

function create_seo_name($string) {
    $text = mb_strtolower($string);
    $text = trim($text);
    if (function_exists('transliterator_transliterate')) {
        $text = transliterator_transliterate('Latin-ASCII', $text);
    }
    $text = preg_replace('/ /', '-', $text);
    $text = preg_replace('[^A-z0-9]', '', $text);
    return $text;
}

/*/set_error_handler('handle_error');
function handle_error($type, $message, $file, $line) {
    throw new ErrorException($message, 0, $type, $file, $line);
} 

//set_exception_handler('handle_exception');
function handle_exception($e) {
    error_log($e);
    http_response_code(500);
    echo "<h1>Desculpa, ocurreu um problema</h1>";
}

//register_shutdown_function('handle_shutdown');
function handle_shutdown() {
    $error = error_get_last();
    if ($error) {
        $e = new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
        handle_exception($e);
    }
}*/
