<?php


/*
 * The MIT License
 *
 * Copyright 2017 mihajlo.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * @project KING API - Framework for Rest APIs 
 * @project_url https://king.php.mk/
 * 
 *
 * @author Mihajlo Siljanoski
 * @url https://mk.linkedin.com/in/msiljanoski
 * @email mihajlo.siljanoski@gmail.com
 * @skype mihajlo.siljanoski
 * 
 */


class User {
    public static function index($db,$a,$b){
        
        echo 'testtttttt '.$a.'  ..... '.$b;
        
    }
    
    
    public static function post($db,$a,$b){
        
        $user=Auth::validate();
        
        $mail=Lib::load('Email',Config::item('email_config'));
        
        //more info: http://xmodule.eco.mk/module/validation
        $validator=Lib::load('validator');
        
        $rules_array = array(
        'name'=>array('type'=>'string',  'required'=>true, 'min'=>3, 'max'=>10, 'trim'=>true),
        'email'=>array('type'=>'email', 'required'=>true, 'min'=>1, 'max'=>500, 'trim'=>true));
        
        
        $validator->addSource(Request::post());
        $validator->addRules($rules_array);
        $validator->run();
        
        if(sizeof($validator->errors) > 0){
            Response::json(['user'=>$user,'errors'=>$validator->errors],500);
        }
        
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
