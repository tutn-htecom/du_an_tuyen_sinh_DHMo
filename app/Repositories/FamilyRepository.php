<?php

namespace App\Repositories;

use App\Models\FamilyInformations;

class FamilyRepository extends BaseRepository
{
    public $model;
    public function __construct(FamilyInformations $model)
    {        
        $this->model = $model;        
    }
    
}
