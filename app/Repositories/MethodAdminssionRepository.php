<?php

namespace App\Repositories;

use App\Models\Marjors;
use App\Models\MethodAdminssions;

class MethodAdminssionRepository extends BaseRepository
{
    public $model;
    public function __construct(MethodAdminssions $model)
    {        
        $this->model = $model;        
    }
    
   
}
