<?php

namespace App\Repositories;

use App\Models\DegreeInformations;
class DegreeRepository extends BaseRepository
{
    public $model;
    public function __construct(DegreeInformations $model)
    {        
        $this->model = $model;        
    }
    
}
