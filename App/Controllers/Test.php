<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author mihajlo
 */
class Test {
    
    public static function filedatabase_get($db){
        
        $fdb=Lib::load('filedb','test_file_database',APP_PATH.'storage/databases');
        
        Response::json(['result'=>$fdb->read('server_info','server_data')],200);
        
    }
    
    
    public static function filedatabase_post($db){
        
        $fdb=Lib::load('filedb','test_file_database',APP_PATH.'storage/databases');
        
        $fdb->save('server_info','server_data',$_SERVER);
        
        Response::json(['msg'=>'server_data created!'],200);
        
    }
    
    public static function filedatabase_delete($db){
        
        $fdb=Lib::load('filedb','test_file_database',APP_PATH.'storage/databases');
        
        $fdb->remove('server_info','server_data');
        
        Response::json(['msg'=>'server_data deleted!'],200);
        
    }
    
    
}
