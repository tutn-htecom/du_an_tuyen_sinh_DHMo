<?php

namespace App\Repositories;

use App\Models\Marjors;
class MarjorsRepository extends BaseRepository
{
    public $model;
    public function __construct(Marjors $model)
    {        
        $this->model = $model;        
    }
    
   
}
