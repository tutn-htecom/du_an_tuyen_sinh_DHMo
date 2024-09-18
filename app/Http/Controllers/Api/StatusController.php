<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Services\Status\StatusInterface;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $status_interface;
    public function __construct(StatusInterface $status_interface)
    {
        $this->status_interface = $status_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->status_interface->index($params);     
    }
    public function details($id) {
        return $this->status_interface->details($id);
    }
    public function create(CreateStatusRequest $request) {
        $params =  $request->all();
        return  $this->status_interface->create($params);  
    }
    public function createMultiple(Request $request) {
        $params =  $request->all();
        return  $this->status_interface->createMultiple($params);  
    }
    public function update(UpdateStatusRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->status_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->status_interface->delete($id);  
    }
}
