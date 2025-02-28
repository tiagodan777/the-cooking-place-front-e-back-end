<?php
function is_number($number, $min = 0, $max = 100) {
    return ($number >= $min && $number <= $max);
}

function is_text($text, $min = 0, $max = 100) {
    $lenght = mb_strlen($text);
    return ($lenght >= $min && $lenght <= $max);
}

function is_member_id($member_id, $member_id_list) {
    foreach ($member_id_list as $member) {
        if ($member_id == $member) {
            return true;
        }
    }
    return false;
}

function is_category_id($category_id, $category_id_list) {
    foreach ($category_id_list as $category) {
        if ($category_id == $category['id']) {
            return true;
        }
    }
    return false;
}
