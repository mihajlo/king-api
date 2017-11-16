<?php

/**
 * Description of Request
 *
 * @author mihajlo
 */
class Request {

    public static function post($key = false) {

        if (!@$_POST && !$key) {
            return [];
        }
        if (!@$_POST && $key) {
            return NULL;
        }

        $postData = $_POST;
        $filtered_post = [];

        foreach ($postData as $k => $p) {
            $tmpP= trim($p);
            $tmpP=htmlspecialchars($tmpP,ENT_QUOTES);
            //$tmpP=htmlspecialchars_decode($tmpP,ENT_QUOTES);
            $filtered_post[$k]=$tmpP; 
        }

        if ($key) {
            return $filtered_post[$key];
        }
        return $filtered_post;
    }

}
