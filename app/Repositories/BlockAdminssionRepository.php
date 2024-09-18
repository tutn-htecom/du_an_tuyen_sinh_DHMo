<?php

namespace App\Repositories;

use App\Models\BlockAdminssions;
use App\Models\Contacts;
class BlockAdminssionRepository extends BaseRepository
{
    public $model;
    public function __construct(BlockAdminssions $model)
    {        
        $this->model = $model;        
    }
    
}
