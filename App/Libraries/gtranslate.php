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


class gtranslate {

    function __construct() {
        $this->translate_url = 'https://translate.google.com/m?ie=UTF-8&prev=_m&hl=en&';
        $this->urlReferer = 'https://translate.google.com/m';
        $this->userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    }

    public function translate($text, $to, $from = '',$cache=false) {
        $url = $this->translate_url . 'sl=' . $from . '&tl=' . $to . '&q=' . urlencode(@$text);
        
        if(file_exists(APP_PATH.'storage/cache/'.$to.'/'.md5($url).'.cache') && $cache){
            return file_get_contents(APP_PATH.'storage/cache/'.$to.'/'.md5($url).'.cache');
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_REFERER, $this->urlReferer);
        curl_setopt($ch, CURLOPT_URL, $url);
        $resp = $this->parseResponse(curl_exec($ch));
        if(!file_exists(APP_PATH.'storage/cache')){
            @mkdir(APP_PATH.'storage/cache');
        }
        if(!file_exists(APP_PATH.'storage/cache/'.$to)){
            @mkdir(APP_PATH.'storage/cache/'.$to);
        }
        @file_put_contents(APP_PATH.'storage/cache/'.$to.'/'.md5($url).'.cache', $resp);
        return $resp;
    }

    private function parseResponse($str = '') {
        $result = strip_tags($str, '<div>');
        $result = explode('<', substr($result, strpos($result, 'class="t0"') + 11, strpos($result, 'class="t0"')));
        $result = $result[0];
        return $result;
    }

}