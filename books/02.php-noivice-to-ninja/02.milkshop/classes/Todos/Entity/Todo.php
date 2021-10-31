<?php

namespace Todos\Entity;

class Todo
{
    public $id;
    public $title;
    public $completed_at;
    public $content;
    public $date;
    
    const COL_ID = 'id';
    const COL_TITLE = 'title';
    const COL_COMPLETED_AT = 'completed_at';
    const COL_CONTENT = 'content';
    const COL_DATE = 'date';
    
    const CLASS_NAME = '\Todos\Entity\Todo';
    
    public function __construct()
    {
    }
}
