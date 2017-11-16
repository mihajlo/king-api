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
    
    
    public static function translate($db,$to,$from){
        
        //example request: http://api.local/test/translate/mk/en     post_vars: text
        
        $translator=Lib::load('gtranslate');
        
        $text_for_translation=Request::post('text');
        
        $translated=$translator->translate($text_for_translation, $to,$from,true);
        
        Response::json(['text_for_translation'=>$text_for_translation,'translated_string'=>$translated],200);
        
    }
    
    
    public static function filedatabase_get($db){
        
        $fdb=Lib::load('filedb','test_file_database',APP_PATH.'storage/databases');
        
        Response::json(['result'=>$fdb->read('server_info','server_data')],200);
        
    }
    
    
    public static function filedatabase_post($db){
        
        $fdb=Lib::load('filedb','test_file_database',APP_PATH.'storage/databases');
        
        $fdb->save('server_info','server_data',$_SERVER);
        
        
        //example to use as non-SQL db
        $fdb->create_table('user');
        
        //if you like to add record in user table(folder) if table(folder) user doesn't exist automaticaly will be created
        $user=$fdb->insert('user',['name'=>'Mihajlo','surname'=>'Siljanoski','web'=>'http://mihajlo.biz/','username'=>'admin','password'=>md5('admin')]);
        //more examples: https://github.com/mihajlo/file-database
        
        Response::json(['msg'=>'server_data created!','user_data'=>$user],200);
        
    }
    
    public static function filedatabase_delete($db){
        
        $fdb=Lib::load('filedb','test_file_database',APP_PATH.'storage/databases');
        
        $fdb->remove('server_info','server_data');
        
        Response::json(['msg'=>'server_data deleted!'],200);
        
    }
    
    
}
