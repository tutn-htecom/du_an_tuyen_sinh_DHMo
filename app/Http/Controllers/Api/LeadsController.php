<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactsRequest;
use App\Http\Requests\CreateFamilyRequest;
use App\Http\Requests\CreateLeadsRequest;
use App\Http\Requests\CreateScoreAdminssionRequest;
use App\Http\Requests\LeadsImportRequest;
use App\Http\Requests\RegisterProfileRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateStatusLeadRequest;
use App\Http\Requests\UploadImageRequest;
use App\Http\Requests\UploadMultipleImagesRequest;
use App\Imports\LeadsImport;
use App\Services\Leads\LeadsInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LeadsController extends Controller
{
    protected  $leads_interface;  
    protected  $excel;  
    public function __construct(LeadsInterface $leads_interface, Excel $excel)
    {
        $this->leads_interface =  $leads_interface;   
        $this->excel =  $excel;      
    }
    // RegisterProfileRequest
    public function create( RegisterProfileRequest $request) {        
        $params = $request->all();
        return $this->leads_interface->create($params);
    }
    public function uAvatar(UploadImageRequest $request, $id) {              
        $params = $request->all();
        return $this->leads_interface->uAvatar($params, $id);
    }
    public function uPersonal(UpdateProfileRequest $request, $id) {        
        $params = $request->all();
        return $this->leads_interface->uPersonal($params, $id);
    }
    public function contacts(CreateContactsRequest $request, $id) {        
        $params = $request->all();
        return $this->leads_interface->contacts($params, $id);
    }
    // CreateFamilyRequest
    public function family(CreateFamilyRequest $request, $id) {        
        $params = $request->all();
        return $this->leads_interface->family($params, $id);
    }
    public function score(CreateScoreAdminssionRequest $request, $id) {
        $params = $request->all();
        return $this->leads_interface->score($params, $id);
    }
    public function confirm(UploadMultipleImagesRequest $request, $id) {
        $params = $request->all();
        return $this->leads_interface->confirm($params, $id);
    }

    // ---------------------------------------------------------------
    //CRM
    public function data(Request $request){           
        $params = $request->all();
        return $this->leads_interface->data($params);
    }
    public function details($id){                   
        return $this->leads_interface->data($id);
    }
    public function update(UpdateLeadRequest $request, $id){                   
        $params = $request->all();
        return $this->leads_interface->update($params,$id);
    }
    public function crm_create_lead(CreateLeadsRequest $request){                   
        $params = $request->all();
        return $this->leads_interface->crm_create_lead($params);
    }
    public function delete($id){                             
        return $this->leads_interface->delete($id);
    }
    public function update_status_lead(UpdateStatusLeadRequest $request, $id){
        $params = $request->all();
        return $this->leads_interface->update_status_lead($params,$id);
    }
    // Xuất file
    public function export(Request $request){        
        ob_end_clean(); // this
        ob_start(); // and this
        $params = $request->all();
        return $this->leads_interface->export($params);
    }
    public function import(Request $request){
        $params = $request->all();        
        return $this->leads_interface->import($params);
    }
}
