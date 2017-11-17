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
