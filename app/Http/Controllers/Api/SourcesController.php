<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSourcesRequest;
use App\Http\Requests\UpdateSourcesRequest;
use App\Services\Sources\SourcesInterface;
use Illuminate\Http\Request;

class SourcesController extends Controller
{   
    protected $sources_interface;
    public function __construct(SourcesInterface $sources_interface)
    {
        $this->sources_interface = $sources_interface;
    }
    public function index(Request $request){
        $params =  $request->all();  
        return  $this->sources_interface->index($params);     
    }
    public function details($id) {
        return $this->sources_interface->details($id);
    }
    public function create(CreateSourcesRequest $request) {
        $params =  $request->all();
        return  $this->sources_interface->create($params);  
    }
    public function createMultiple(Request $request) {
        $params =  $request->all();
        return  $this->sources_interface->createMultiple($params);  
    }
    public function update(UpdateSourcesRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->sources_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->sources_interface->delete($id);  
    }
}
