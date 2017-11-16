<?php

class Config {
    
    public static function item($key=false){
        global $config;
        if(!$key){
            return $config;
        }
        return @$config[$key];
    }
    
}
