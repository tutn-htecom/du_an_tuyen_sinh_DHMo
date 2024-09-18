<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEducationTypesRequest;
use App\Http\Requests\UpdateEducationTypesRequest;
use App\Services\EducationsTypes\EducationsTypesInterface;
use Illuminate\Http\Request;

class EducationsTypesController extends Controller
{
    protected $type_repository;
    public function __construct(EducationsTypesInterface $type_repository)
    {
        $this->type_repository = $type_repository;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->type_repository->index($params);     
    }
    public function details($id) {
        return $this->type_repository->details($id);
    }
    public function create(CreateEducationTypesRequest $request) {        
        $params =  $request->all();
        return  $this->type_repository->create($params);  
    }
    public function createMultiple(Request $request) {        
        $params =  $request->all();
        return  $this->type_repository->createMultiple($params);  
    }
    public function update(UpdateEducationTypesRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->type_repository->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->type_repository->delete($id);  
    }
}
