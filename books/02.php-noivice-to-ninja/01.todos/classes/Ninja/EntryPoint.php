<?php

namespace Ninja;

use Ninja\Routes;

class EntryPoint
{
    private $route;
    private $method;
    private $route_handler;

    public function __construct($route, $method, Routes $route_handler)
    {
        $this->route = $route;
        $this->route_handler = $route_handler;
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
        include __DIR__ . '/../../ninja-config.php';
        
        $routes = $this->route_handler->getRoutes();

        $authentication = $this->route_handler->getAuthentication();

        if ($ninja_global_configs['auth'] == true) {
            $login_required = $routes[$this->route]['login'] ?? false;
            if ($authentication && $login_required) {
                if (!$authentication->isLoggedIn()) {
                    header('location: /login/error');
                    exit();
                }
            }
        }

        if ($ninja_global_configs['permission']) {
            $permission_required = $routes[$this->route]['permissions'] ?? false;
            if ($permission_required) {
                $permission = $routes[$this->route]['permissions'];

                if (!$this->route_handler->checkPermission($permission)) {
                    header('location: /login/error');
                    exit();
                }
            }
        }
        
        if (isset($routes[$this->route]['REDIRECT'])) {
            http_response_code(301);
            header('location: ' . $routes[$this->route]['REDIRECT']);
            exit();
        }

        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];

        $page = $controller->$action();

        $title = $page['title'];
        $templateFileName = $page['template'];
        $variables = $page['variables'] ?? [];
        $custom_styles = $page['custom_styles'] ?? [];
        $custom_scripts = $page['custom_scripts'] ?? [];

        $output = $this->loadTemplate($templateFileName, $variables) ?? '';

        $template_args = [
            'content' => $output,
            'title' => $title,
            'custom_styles' => $custom_styles,
            'custom_scripts' => $custom_scripts
        ];

        if ($ninja_global_configs['auth']) {
            $template_args['loggedIn'] = $authentication->isLoggedIn() ?? null;
        }

        echo $this->loadTemplate('master.html.php', $template_args);
    }
}
