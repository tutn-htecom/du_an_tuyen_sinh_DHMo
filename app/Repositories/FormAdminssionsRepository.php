<?php

namespace App\Repositories;

use App\Models\FormAdminssions;

class FormAdminssionsRepository extends BaseRepository
{
    public $model;
    public function __construct(FormAdminssions $model)
    {        
        $this->model = $model;        
    }
    
   
}
