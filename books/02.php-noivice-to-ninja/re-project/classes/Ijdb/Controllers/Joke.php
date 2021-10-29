<?php

namespace Ijdb\Controllers;

use Ninja\DatabaseTable;
use Ninja\Authentication;

class Joke
{
    private $authorsTable;
    private $jokesTable;
    private $categoriesTable;
    private $authentication;

    public function __construct(
        DatabaseTable $authorsTable,
        DatabaseTable $jokesTable,
        DatabaseTable $categoriesTable,
        Authentication $authentication
    ) {
        $this->authorsTable = $authorsTable;
        $this->jokesTable = $jokesTable;
        $this->categoriesTable = $categoriesTable;
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
        if (isset($_GET['category'])) {
            $category = $this->categoriesTable->findById($_GET['category']);
            $jokes = $category->getJokes();
        } else {
            $jokes = $this->jokesTable->findAll();
        }

        $categories = $this->categoriesTable->findAll();

        $author = $this->authentication->getUser();
        $title = 'Joke List';

        $totalJokes = count($jokes);

        return [
            'template' => 'jokes.html.php',
            'title' => $title,
            'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes,
                'userid' => $author->id ?? null,
                'categories' => $categories
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

        $jokeEntity = $author->addJoke($joke);

        foreach ($_POST['category'] as $categoryId) {
            $jokeEntity->addCategory($categoryId);
        }

        header('Location: /joke/list');
        exit();
    }

    public function edit()
    {
        $author = $this->authentication->getUser();
        $categories = $this->categoriesTable->findAll();

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
                'userid' => $author->id ?? null,
                'categories' => $categories
            ]
        ];
    }
}
