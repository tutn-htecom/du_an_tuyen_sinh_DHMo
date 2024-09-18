<?php

namespace App\Repositories;

use App\Models\LstStatus;

class StatusRepository extends BaseRepository
{
    public $model;
    public function __construct( LstStatus $model)
    {        
        $this->model = $model;        
    }
    
}
