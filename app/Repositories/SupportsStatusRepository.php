<?php

namespace App\Repositories;

use App\Models\SupportsStatus;

class SupportsStatusRepository extends BaseRepository
{
    public $model;
    public function __construct(SupportsStatus $model)
    {        
        $this->model = $model;        
    }
    
}
