<?php
function pdo($pdo, $sql, $arguments = null) {
    if (!$arguments) {
        return $pdo->query($sql);
    }
    $statement = $pdo->prepare($sql);
    $statement->execute($arguments);
    return $statement;
}

function html_escape($text) {
    $text = $text ?? '';

    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false);
}

function postado_ha_x_horas($string) {
    $idade = time() - 3600 - strtotime($string);
    if ($idade < 60) {
        return [date('s', $idade), 'segundos'];
    } elseif($idade < 3600) {
        return [date('i', $idade), 'minutos'];
    } elseif ($idade < 86400) {
        return [date('G', $idade), 'horas'];
    } elseif ($idade < 604800) {
        return [date('j', $idade), 'dias'];
    } else {
        return [date('d F Y'), ''];
    }
}