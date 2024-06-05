<?php

namespace classes;

class Router
{
    protected array $routes = [];
    protected string $uri;
    protected string $method;


    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    public function route()
    {
        $is_route = false;

        foreach ($this->routes as $route) {
            if (($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method))) {


                if ($route['middleware']) {
                    $middleware = MIDDLEWARE[$route['middleware']] ?? false;
                    if (!$middleware) {
                        throw new \Exception("Incorrect middleware {$route['middleware']}");
                    }
                    (new $middleware)->handle();
                }

                $route_name = CONTROLLERS . "/{$route['controller']}";

                if (file_exists($route_name)) {
                    require $route_name;
                } else {
                    echo "Файл $route_name не существует";
//                    throw new Exception('Controller not found');
                }

                $is_route = true;
                break;
            }
        }
        if(!$is_route){
            echo 'Страница не найдена.';
        }
    }


    public function add($uri, $controller, $method): Router
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,

        ];
        return $this;
    }

    public function only($middleware)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'DELETE');
    }

}