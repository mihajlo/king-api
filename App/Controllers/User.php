<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author mihajlo
 */
class User {
    public static function index($db,$a,$b){
        
        echo 'testtttttt '.$a.'  ..... '.$b;
        
    }
    
    
    public static function post($db,$a,$b){
        
        $user=Auth::validate();
        
        $request_data=Request::post();
        
        Response::json(['user'=>$user,'request_data'=>$request_data,'server'=>$_SERVER],200);
        
    }
}
