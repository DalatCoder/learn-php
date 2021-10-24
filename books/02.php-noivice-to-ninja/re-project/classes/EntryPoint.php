<?php

class EntryPoint
{
    private $route;
    private $routes;

    public function __construct($route, $routes)
    {
        $this->route = $route;
        $this->routes = $routes;
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
        include __DIR__ . '/../templates/' . $templateFileName;

        return ob_get_clean();
    }

    public function run()
    {
        $page = $this->routes->callAction($this->route);

        $title = $page['title'];
        $templateFileName = $page['template'];
        $variables = $page['variables'] ?? [];

        $output = $this->loadTemplate($templateFileName, $variables);

        include __DIR__ . '/../templates/layout.html.php';
    }
}
