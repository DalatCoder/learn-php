<?php

namespace Ijdb\Controllers;

use Ninja\DatabaseTable;

class Register
{
    private DatabaseTable $authorsTable;

    public function __construct(DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function showForm()
    {
        $title = 'Register User';

        return [
            'template' => 'register.html.php',
            'title' => $title,
            'variables' => []
        ];
    }
}
