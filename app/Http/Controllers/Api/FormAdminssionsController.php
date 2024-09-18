<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFormAdminssionsRequest;
use App\Http\Requests\UpdateFormAdminssionsRequest;
use App\Services\FormAdminssions\FormAdminssionsInterface;
use Illuminate\Http\Request;

class FormAdminssionsController extends Controller
{
    protected $form_interface;
    public function __construct(FormAdminssionsInterface $form_interface)
    {
        $this->form_interface = $form_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->form_interface->index($params);     
    }
    public function details($id) {
        return $this->form_interface->details($id);
    }
    public function create(CreateFormAdminssionsRequest $request) {
        $params =  $request->all();
        return  $this->form_interface->create($params);  
    }
    public function createMultiple(Request $request) {        
        $params =  $request->all();
        return  $this->form_interface->createMultiple($params);  
    }
    
    public function update(UpdateFormAdminssionsRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->form_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->form_interface->delete($id);  
    }
}
