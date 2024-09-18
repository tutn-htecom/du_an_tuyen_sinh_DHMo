<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMethodAdminssionRequest;
use App\Http\Requests\UpdateMethodAdminssionsRequest;
use App\Services\MethodAdminssions\MethodAdminssionsInterface;
use Illuminate\Http\Request;

class MethodAdminssionController extends Controller
{
    protected $method_interface;
    public function __construct(MethodAdminssionsInterface $method_interface)
    {
        $this->method_interface = $method_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->method_interface->index($params);     
    }
    public function details($id) {
        return $this->method_interface->details($id);
    }
    public function create(CreateMethodAdminssionRequest $request) {
        $params =  $request->all();
        return  $this->method_interface->create($params);  
    }
    public function createMultiple(Request $request) {        
        $params =  $request->all();
        return  $this->method_interface->createMultiple($params);  
    }
    
    public function update(UpdateMethodAdminssionsRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->method_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->method_interface->delete($id);  
    }
}
