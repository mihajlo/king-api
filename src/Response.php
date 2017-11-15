<?php

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
