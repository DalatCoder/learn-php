<?php

namespace Ijdb\Controllers;

use Ninja\DatabaseTable;

class Register
{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function registrationForm()
    {
        return [
            'template' => 'register.html.php',
            'title' => 'Register an account',
            'variables' => []
        ];
    }

    public function success()
    {
        return [
            'template' => 'registersuccess.html.php',
            'title' => 'Registration Successful',
            'variables' => []
        ];
    }

    public function registerUser()
    {
        $author = $_POST['author'];

        $valid = true;
        $errors = [];

        if (empty($author['name'])) {
            $valid = false;
            $errors[] = 'Name cannot be blank';
        }

        if (empty($author['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
        } else if (filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = 'Invalid email address';
        } else {
            $author['email'] = strtolower($author['email']);

            if (count($this->authorsTable->find('email', $author['email'])) > 0) {
                $valid = false;
                $errors[] = 'That email address is already registered';
            }
        }

        if (empty($author['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
        }

        if ($valid) {
            $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);

            $this->authorsTable->save($author);
            header('Location: /author/success');

            exit();
        } else {
            return [
                'template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'author' => $author
                ]
            ];
        }
    }

    public function list()
    {
        $authors = $this->authorsTable->findAll();

        return [
            'template' => 'authorlist.html.php',
            'title' => 'Author List',
            'variables' => [
                'authors' => $authors
            ]
        ];
    }

    public function permissions()
    {
        $author = $this->authorsTable->findById($_GET['id']);

        $reflected = new \ReflectionClass('\Ijdb\Entity\Author');
        $constants = $reflected->getConstants();

        return [
            'template' => 'permissions.html.php',
            'title' => 'Edit Permissions',
            'variables' => [
                'author' => $author,
                'permissions' => $constants
            ]
        ];
    }

    public function savePermissions()
    {
        $author = [
            'id' => $_GET['id'],
            'permissions' => array_sum($_POST['permissions'] ?? [])
        ];

        $this->authorsTable->save($author);

        header('location: /author/list');
    }
}
