<?php

class EntryPoint
{
    private $route;

    public function __construct($route)
    {
        $this->route = $route;
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

    private function callAction()
    {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/DatabaseTable.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        if ($this->route === 'joke/list') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->list();
        } else if ($this->route === 'joke/edit') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->edit();
        } else if ($this->route === 'joke/delete') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->delete();
        } else if ($this->route === 'register') {
            include __DIR__ . '/../controllers/RegisterController.php';
            $controller = new RegisterController($authorsTable);
            $page = $controller->showForm();
        } else {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->home();
        }

        return $page;
    }

    public function run()
    {
        $page = $this->callAction();

        $title = $page['title'];
        $templateFileName = $page['template'];
        $variables = $page['variables'] ?? [];

        $output = $this->loadTemplate($templateFileName, $variables);

        include __DIR__ . '/../templates/layout.html.php';
    }
}
