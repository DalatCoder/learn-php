<?php

class JokeController
{
    private DatabaseTable $authorsTable;
    private DatabaseTable $jokesTable;

    public function __construct(DatabaseTable $authorsTable, DatabaseTable $jokesTable)
    {
        $this->authorsTable = $authorsTable;
        $this->jokesTable = $jokesTable;
    }

    public function home()
    {
        $title = 'Internet Joke Database';

        ob_start();

        include __DIR__ . '/../templates/home.html.php';

        $output = ob_get_clean();

        return [
            'title' => $title,
            'output' => $output
        ];
    }

    public function list()
    {
        $result = $this->jokesTable->findAll();

        $jokes = [];
        foreach ($result as $joke) {
            if (isset($joke['authorid'])) {
                $author = $this->authorsTable->findById($joke['authorid']);

                $jokes[] = [
                    'id' => $joke['id'],
                    'joketext' => $joke['joketext'],
                    'jokedate' => $joke['jokedate'],
                    'name' => $author['name'],
                    'email' => $author['email']
                ];
            }
        }

        $title = 'Joke List';

        $totalJokes = $this->jokesTable->total();

        ob_start();

        include __DIR__ . '/../templates/jokes.html.php';

        $output = ob_get_clean();

        return [
            'title' => $title,
            'output' => $output
        ];
    }

    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        header('Location: jokes.php');
    }

    public function edit()
    {
        if (isset($_POST['joke'])) {
            $joke = $_POST['joke'];

            $joke['jokedate'] = new DateTime();
            $joke['authorid'] = 1;

            $this->jokesTable->save($joke);

            header('Location: jokes.php');
            exit();
        } else {
            $title = 'Create New Joke';

            if (isset($_GET['jokeid'])) {
                $joke = $this->jokesTable->findById($_GET['jokeid']);
                $title = 'Edit Joke';
            }

            ob_start();

            include __DIR__ . '/../templates/editjoke.html.php';

            $output = ob_get_clean();

            return [
                'title' => $title,
                'output' => $output
            ];
        }
    }
}
