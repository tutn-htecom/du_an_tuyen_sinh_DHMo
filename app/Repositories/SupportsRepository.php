<?php

namespace App\Repositories;

use App\Models\Supports;

class SupportsRepository extends BaseRepository
{
    public $model;
    public function __construct(Supports $model)
    {        
        $this->model = $model;        
    }
    
}
