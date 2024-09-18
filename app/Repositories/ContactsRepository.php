<?php

namespace App\Repositories;

use App\Models\Contacts;
class ContactsRepository extends BaseRepository
{
    public $model;
    public function __construct(Contacts $model)
    {        
        $this->model = $model;        
    }
    
}
