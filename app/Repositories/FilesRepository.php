<?php

namespace App\Repositories;
use App\Models\Files;

class FilesRepository extends BaseRepository
{
    public $model;
    public function __construct(Files $model)
    {        
        $this->model = $model;        
    }
    
}
