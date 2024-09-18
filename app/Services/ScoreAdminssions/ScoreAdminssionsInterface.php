<?php

namespace App\Services\ScoreAdminssions;

interface ScoreAdminssionsInterface
{       
    public function index($params);
    public function details($id);
    public function create($params, $id);    
    public function createMultiple($params);    
    public function update($params, $id);
    public function delete($id);
    
}
