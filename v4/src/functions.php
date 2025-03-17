<?php
function postado_ha_x_horas($string) {
    $idade = time() - 3600 - strtotime($string);
    if ($idade < 60) {
        return date('s', $idade) . ' segundos';
    } elseif($idade < 3600) {
        return date('i', $idade) . ' minutos';
    } elseif ($idade < 86400) {
        return date('G', $idade) . ' horas';
    } elseif ($idade < 604800) {
        return date('j', $idade) . ' dias';
    } else {
        return date('j F Y', $idade) . '';
    }
}

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

//set_error_handler('handle_error');
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
}
