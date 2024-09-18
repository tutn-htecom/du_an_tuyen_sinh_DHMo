<?php

namespace App\Repositories;

use App\Models\Leads;

class LeadsRepository extends BaseRepository
{
    public $model;
    public function __construct(Leads $model)
    {        
        $this->model = $model;        
    }
    
}
