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


class Request {

    public static function post($key = false) {

        if (!@$_POST && !$key) {
            return [];
        }
        if (!@$_POST && $key) {
            return NULL;
        }

        $postData = $_POST;
        $filtered_post = [];

        foreach ($postData as $k => $p) {
            $tmpP= trim($p);
            $tmpP=htmlspecialchars($tmpP,ENT_QUOTES);
            //$tmpP=htmlspecialchars_decode($tmpP,ENT_QUOTES);
            $filtered_post[$k]=$tmpP; 
        }

        if ($key) {
            return @$filtered_post[$key];
        }
        return $filtered_post;
    }

}
