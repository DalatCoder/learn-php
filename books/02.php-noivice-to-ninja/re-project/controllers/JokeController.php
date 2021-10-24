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

        return [
            'template' => 'home.html.php',
            'title' => $title,
            'variables' => []
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

        return [
            'template' => 'jokes.html.php',
            'title' => $title,
            'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes
            ]
        ];
    }

    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        header('Location: /joke/list');
        exit();
    }

    public function edit()
    {
        if (isset($_POST['joke'])) {
            $joke = $_POST['joke'];

            $joke['jokedate'] = new DateTime();
            $joke['authorid'] = 1;

            $this->jokesTable->save($joke);

            header('Location: /joke/list');
            exit();
        } else {
            $title = 'Create New Joke';

            if (isset($_GET['jokeid'])) {
                $joke = $this->jokesTable->findById($_GET['jokeid']);
                $title = 'Edit Joke';
            }

            return [
                'template' => 'editjoke.html.php',
                'title' => $title,
                'variables' => [
                    'joke' => $joke ?? null
                ]
            ];
        }
    }
}
