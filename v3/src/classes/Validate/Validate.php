<?php
class Validate {
    public static function isNumber($number, $min = 0, $max = 100) {
        return ($number >= $min && $number <= $max);
    }
    
    public static function isText($text, $min = 0, $max = 100) {
        $lenght = mb_strlen($text);
        return ($lenght >= $min && $lenght <= $max);
    }
    
    public static function isMemberId($member_id, $member_id_list) {
        foreach ($member_id_list as $member) {
            if ($member_id == $member) {
                return true;
            }
        }
        return false;
    }
    
    public static function isCategoryId($category_id, $category_id_list) {
        foreach ($category_id_list as $category) {
            if ($category_id == $category['id']) {
                return true;
            }
        }
        return false;
    }
}

