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
        $post_per_page = 1;
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * $post_per_page;

        $totalJokes = $this->jokesTable->total();

        if (isset($_GET['category'])) {
            $category = $this->categoriesTable->findById($_GET['category']);
            $jokes = $category->getJokes();

            $totalJokes = count($jokes);
            echo $totalJokes . '|' . $offset . '|' . $post_per_page;
            $jokes = array_slice($jokes, $offset, $post_per_page);
        } else {
            $jokes = $this->jokesTable->findAll(null, null, $post_per_page, $offset);
        }

        $categories = $this->categoriesTable->findAll();

        $author = $this->authentication->getUser();
        $title = 'Joke List';

        $number_of_pages = ceil($totalJokes / $post_per_page);

        return [
            'template' => 'jokes.html.php',
            'title' => $title,
            'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes,
                'user' => $author ?? null,
                'categories' => $categories,
                'numberOfPages' => $number_of_pages,
                'currentpage' => $page,
                'category_id' => $_GET['category'] ?? null
            ]
        ];
    }

    public function delete()
    {
        $author = $this->authentication->getUser();
        $joke = $this->jokesTable->findById($_POST['id']);

        if ($joke->authorid != $author->id && !$author->hasPermission(\Ijdb\Entity\Author::DELETE_JOKES)) {
            return;
        }

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
        $jokeEntity->clearCategories();

        if (isset($_POST['category'])) {
            foreach ($_POST['category'] as $categoryId) {
                $jokeEntity->addCategory($categoryId);
            }
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
