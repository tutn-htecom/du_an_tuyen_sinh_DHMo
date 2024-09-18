<?php

namespace App\Services\Leads;

interface LeadsInterface
{       
    public function create($params);     
    public function uAvatar($params, $id);
    public function uPersonal($params, $id);     
    public function contacts($params, $id);     
    public function family($params, $id); 
    public function score($params, $id);    
    public function confirm($params, $id);   
    //crm
    public function data($params); 
    public function details($id);    
    public function update($params, $id);
    public function crm_create_lead($params);
    public function update_status_lead($params, $id);
    public function delete($id);
    public function export($params);
    public function import($params);
}
