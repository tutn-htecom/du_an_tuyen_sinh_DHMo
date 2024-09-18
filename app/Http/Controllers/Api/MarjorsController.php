<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMarjorsRequest;
use App\Http\Requests\UpdateMarjorsRequest;
use App\Services\Marjors\MarjorsInterface;
use Illuminate\Http\Request;

class MarjorsController extends Controller
{
    protected $marjors_interface;
    public function __construct(MarjorsInterface $marjors_interface)
    {
        $this->marjors_interface = $marjors_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->marjors_interface->index($params);     
    }
    public function details($id) {
        return $this->marjors_interface->details($id);
    }
    public function create(CreateMarjorsRequest $request) {
        $params =  $request->all();
        return  $this->marjors_interface->create($params);  
    }
    public function createMultiple(Request $request) {        
        $params =  $request->all();
        return  $this->marjors_interface->createMultiple($params);  
    }
    
    public function update(UpdateMarjorsRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->marjors_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->marjors_interface->delete($id);  
    }
}
