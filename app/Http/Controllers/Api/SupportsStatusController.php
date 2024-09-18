<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSupportsStatusRequest;
use App\Http\Requests\UpdateSupportsStatusRequest;
use App\Services\SupportsStatus\SupportsStatusInterface;
use Illuminate\Http\Request;

class SupportsStatusController extends Controller
{
    protected $sp_status_interface;
    public function __construct(SupportsStatusInterface $sp_status_interface)
    {
        $this->sp_status_interface = $sp_status_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->sp_status_interface->index($params);     
    }
    public function details($id) {
        return $this->sp_status_interface->details($id);
    }
    public function create(CreateSupportsStatusRequest $request) {
        $params =  $request->all();
        return  $this->sp_status_interface->create($params);  
    }
    public function createMultiple(Request $request) {        
        $params =  $request->all();
        return  $this->sp_status_interface->createMultiple($params);  
    }
    
    public function update(UpdateSupportsStatusRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->sp_status_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->sp_status_interface->delete($id);  
    }
}
