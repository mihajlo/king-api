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
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        $mail=Lib::load('Email',Config::item('email_config'));
        
        $mail->from('example@king-api.local','King API APP');
        $mail->reply_to('my-email@gmail.com', 'Explendid Videos');
        $mail->subject('Test subject message');
        $mail->message('<p>Test for message <b>HTML applied!</b></p>');
        $mail->to(Request::post('email'));
        
        //please make sure that you have set email configuration on config file
        //$mail->send();
        
        
        $request_data=Request::post();
        
        Response::json(['user'=>$user,'request_data'=>$request_data,'server'=>$_SERVER],200);
        
    }
}
