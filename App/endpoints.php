<?php


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


