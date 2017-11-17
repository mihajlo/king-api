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

$route->get('/', function($db){ 
    
    $user=Auth::validate();
    
    $data=$db->get('user')->result_array();
    
    Response::json(['authenticated_user'=>$user,'data'=>$data],200);
    
});


$route->get('/test/filestorage', 'Test@filedatabase_get');
$route->post('/test/filestorage', 'Test@filedatabase_post');
$route->delete('/test/filestorage', 'Test@filedatabase_delete');



$route->post('/test/translate/{:any}/{:any}', 'Test@translate');





$route->get('/misko/{:id}/{:name}', 'User@index');
$route->post('/misko/{:id}/{:name}', 'User@post');






$route->get('/user/{:name}/{:id}', function($db,$name, $id){
   echo "name: $name id: $id";
   
   var_dump($_REQUEST);
});



//// get request
//$route->get('/', function($db){ 
//   echo 'Hello'; 
//});
//
//// get with regex named params 
//$route->get('/user/{:name}/{:id}', function($db,$name, $id){
//   echo "name: $name id: $id";
//});
//
//// get with vanilla regex
//$route->get('/user/[a-z]+', function($db){}); 
//
//// Rest-like API
//$route->put('/foo', function($db){});
//$route->delete('/foo', function($db){});
//$route->post('/foo', function($db){});
//
//// MVC example. 
//$route->get('/mvc', 'UserController@index'); 


