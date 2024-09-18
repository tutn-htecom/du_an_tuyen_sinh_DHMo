<?php

namespace App\Services\FormAdminssions;

interface FormAdminssionsInterface
{       
    public function index($params);
    public function details($id);
    public function create($params);
    public function createMultiple($params);        
    public function update($params, $id);
    public function delete($id);    
}
