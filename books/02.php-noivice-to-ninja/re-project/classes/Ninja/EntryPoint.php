<?php

namespace Ninja;

use Ninja\Routes;

class EntryPoint
{
    private $route;
    private $method;
    private $routes;

    public function __construct($route, $method, Routes $routes)
    {
        $this->route = $route;
        $this->routes = $routes;
        $this->method = $method;
        $this->checkUrl();
    }

    private function checkUrl()
    {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('location: ' . strtolower($this->route));
            exit();
        }
    }

    private function loadTemplate($templateFileName, $variables = [])
    {
        extract($variables);

        ob_start();
        include __DIR__ . '/../../templates/' . $templateFileName;

        return ob_get_clean();
    }

    public function run()
    {
        $routes = $this->routes->getRoutes();
        $authentication = $this->routes->getAuthentication();

        $login_required = $routes[$this->route]['login'] ?? false;

        if ($login_required) {
            if (!$authentication->isLoggedIn()) {
                header('location: /login/error');
                exit();
            }
        }

        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];

        $page = $controller->$action();

        $title = $page['title'];
        $templateFileName = $page['template'];
        $variables = $page['variables'] ?? [];

        $output = $this->loadTemplate($templateFileName, $variables);

        include __DIR__ . '/../../templates/layout.html.php';
    }
}
