<?php

namespace App\Repositories;

use App\Models\EducationsTypes;
class EducationsTypesRepository extends BaseRepository
{
    public $model;
    public function __construct(EducationsTypes $model)
    {        
        $this->model = $model;        
    }
    
}
