<?php

namespace Ijdb\Entity;

use Ninja\DatabaseTable;

class Joke
{
    public $id;
    public $authorid;
    public $jokedate;
    public $joketext;

    private $author;
    private $authorsTable;
    private $jokeCategoriesTable;

    public function __construct(DatabaseTable $authorsTable, DatabaseTable $jokeCategoriesTable)
    {
        $this->authorsTable = $authorsTable;
        $this->jokeCategoriesTable = $jokeCategoriesTable;
    }

    public function getAuthor()
    {
        if (empty($this->author)) {
            $this->author = $this->authorsTable->findById($this->authorid);
        }

        return $this->author;
    }

    public function addCategory($categoryId)
    {
        $jokeCat = [
            'jokeid' => $this->id,
            'categoryid' => $categoryId
        ];

        $this->jokeCategoriesTable->save($jokeCat);
    }

    public function hasCategory($categoryId)
    {
        $jokeCategories = $this->jokeCategoriesTable->find('jokeid', $this->id);

        foreach ($jokeCategories as $jokeCategory) {
            if ($jokeCategory->categoryid == $categoryId) {
                return true;
            }
        }
    }

    public function clearCategories()
    {
        $this->jokeCategoriesTable->deleteWhere('jokeid', $this->id);
    }
}
