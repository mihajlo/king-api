<?php

class Router {

    protected $routes = [
        'GET' => [],
        'POST' => [],
        'ANY' => [],
        'PUT' => [],
        'DELETE' => [],
    ];
    public $patterns = [
        ':any' => '.*',
        ':id' => '[0-9]+',
        ':slug' => '[a-z\-]+',
        ':name' => '[a-zA-Z]+',
    ];

    const REGVAL = '/({:.+?})/';

    public function any($path, $handler) {
        $this->addRoute('ANY', $path, $handler);
    }

    public function get($path, $handler) {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler) {
        $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler) {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler) {
        $this->addRoute('DELETE', $path, $handler);
    }

    protected function addRoute($method, $path, $handler) {
        array_push($this->routes[$method], [$path => $handler]);
    }

    public function match(array $server = [], array $post) {
        $requestMethod = $server['REQUEST_METHOD'];
        $requestUri = $server['REQUEST_URI'];

        $restMethod = $this->getRestfullMethod($post);

        if (!$restMethod && !in_array($requestMethod, array_keys($this->routes))) {
            Response::json([], 400);
        }

        $method = $restMethod ?: $requestMethod;
        global $db;
        global $config;
        foreach ($this->routes[$method] as $resource) {

            $args = [];
            $route = key($resource);
            $handler = reset($resource);

            if (preg_match(self::REGVAL, $route)) {
                list($args, $uri, $route) = $this->parseRegexRoute($requestUri, $route);
            }

            if (!preg_match("#^$route$#", $requestUri)) {
                unset($this->routes[$method]);
                continue;
            }

            if (is_string($handler) && strpos($handler, '@')) {
                list($ctrl, $method) = explode('@', $handler);
                if (!@include_once($config['app_path'] . 'Controllers/' . $ctrl . '.php')) {
                    echo 'class not found at : ' . 'App/Controllers/' . $ctrl . '.php';
                }
                call_user_func_array([$ctrl, $method], array_merge([$db], $args));
            }

            if (empty($args)) {
                return call_user_func_array($handler, [$db]);
            }

            return call_user_func_array($handler, array_merge([$db], $args));
        }

        Response::json([], 404);
    }

    protected function getRestfullMethod($postVar) {
        if (array_key_exists('_method', $postVar)) {
            if (in_array($method, array_keys($this->routes))) {
                return $method;
            }
        }
    }

    protected function parseRegexRoute($requestUri, $resource) {
        $route = preg_replace_callback(self::REGVAL, function($matches) {
            $patterns = $this->patterns;
            $matches[0] = str_replace(['{', '}'], '', $matches[0]);

            if (in_array($matches[0], array_keys($patterns))) {
                return $patterns[$matches[0]];
            }
        }, $resource);

        $regUri = explode('/', $resource);

        $args = array_diff(
                array_replace($regUri, explode('/', $requestUri)
                ), $regUri
        );

        return [array_values($args), $resource, $route];
    }

}
