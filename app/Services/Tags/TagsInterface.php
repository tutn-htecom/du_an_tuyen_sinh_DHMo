<?php

namespace App\Services\Tags;

interface TagsInterface
{       
    public function index($params);
    public function details($id);
    public function create($params);  
    public function createMultiple($params);     
    public function update($params, $id);
    public function delete($id);
    
}
