<?php

namespace Ijdb\Controllers;

use Ninja\DatabaseTable;
use Ninja\Authentication;

class Joke
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct(DatabaseTable $authorsTable, DatabaseTable $jokesTable, Authentication $authentication)
    {
        $this->authorsTable = $authorsTable;
        $this->jokesTable = $jokesTable;
        $this->authentication = $authentication;
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
        $jokes = $this->jokesTable->findAll();

        $author = $this->authentication->getUser();
        $title = 'Joke List';

        $totalJokes = $this->jokesTable->total();

        return [
            'template' => 'jokes.html.php',
            'title' => $title,
            'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes,
                'userid' => $author->id ?? null
            ]
        ];
    }

    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        header('Location: /joke/list');
        exit();
    }

    public function saveEdit()
    {
        $author = $this->authentication->getUser();

        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();

        $author->addJoke($joke);

        header('Location: /joke/list');
        exit();
    }

    public function edit()
    {
        $author = $this->authentication->getUser();

        $title = 'Create New Joke';

        if (isset($_GET['jokeid'])) {
            $joke = $this->jokesTable->findById($_GET['jokeid']);
            $title = 'Edit Joke';
        }

        return [
            'template' => 'editjoke.html.php',
            'title' => $title,
            'variables' => [
                'joke' => $joke ?? null,
                'userid' => $author->id ?? null
            ]
        ];
    }
}
