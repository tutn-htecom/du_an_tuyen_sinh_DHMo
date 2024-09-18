<?php

namespace App\Repositories;

use App\Models\Employees;

class EmployeesRepository extends BaseRepository
{
    public $model;
    public function __construct(Employees $model)
    {        
        $this->model = $model;        
    }
    
}
