<?php

namespace App\Repositories;
use App\Models\Tags;

class TagsRepository extends BaseRepository
{
    public $model;
    public function __construct(Tags $model)
    {        
        $this->model = $model;        
    }
    
}
