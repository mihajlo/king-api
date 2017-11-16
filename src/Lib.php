<?php

class Lib {
    public static function load($lib,$args=[]){
        global $config;
        @require_once($config['app_path'].'Libraries/'.$lib.'.php');
        if($args){
            $args=func_get_args();
            unset($args[0]);
            $args= array_values($args);
            return new $lib(...$args);
        }
        return new $lib();
    }
}
