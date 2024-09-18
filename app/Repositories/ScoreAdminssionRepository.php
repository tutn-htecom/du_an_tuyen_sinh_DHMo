<?php

namespace App\Repositories;

use App\Models\ScoreAdminssions;

class ScoreAdminssionRepository extends BaseRepository
{
    public $model;
    public function __construct(ScoreAdminssions $model)
    {        
        $this->model = $model;        
    }

}
