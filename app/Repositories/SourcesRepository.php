<?php

namespace App\Repositories;

use App\Models\Sources;

class SourcesRepository extends BaseRepository
{
    public $model;
    public function __construct(Sources $model)
    {        
        $this->model = $model;        
    }
    
}
