<?php

class Auth {
    
    public static function validate(){
        global $config;
        $valid_passwords = $config['auth'];
        $valid_users = array_keys($valid_passwords);

        $user = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];

        $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

        if (!$validated) {
          @header('WWW-Authenticate: Basic realm="Authentication"');
          Response::json([],401);
        }
    }
    
}
