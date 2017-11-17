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

class Response {

    public static function json($data, $code = 200) {

        global $config;

        @header('Access-Control-Allow-Origin: ' . $config['origin']);
        @header('Content-Type: application/json');
        @header('Cache-Control: no-store, no-cache, must-revalidate');
        @header('Pragma: no-cache');
        @http_response_code($code);

        $error = true;
        $status_text = 'error';
        
        if (in_array(http_response_code(), ['200', '302', '303'])) {
            $status_text = 'OK';
            $error = false;
        }

        $output_data = [
            'error' => $error,
            'status_text' => $status_text,
            'status_code' => http_response_code()
        ];
        
        if (http_response_code() == 404) {
            $output_data['status_msg'] = $config['error_codes'][404];
        }
        if (http_response_code() == 500) {
            $output_data['status_msg'] = $config['error_codes'][500];
        }
        if (http_response_code() == 400) {
            $output_data['status_msg'] = $config['error_codes'][400];
        }
        if (http_response_code() == 401) {
            $output_data['status_msg'] = $config['error_codes'][401];
        }

        echo json_encode(array_merge($output_data, $data), JSON_PRETTY_PRINT);
        exit();
    }

}
