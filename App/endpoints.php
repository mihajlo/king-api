<?php


$route->get('/', function($db){ 
    
    $data=$db->get('user')->result_array();
    
    
    Response::json(['data'=>$data],200);
    
    
});







$route->get('/misko/{:id}/{:name}', 'User@index');






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


