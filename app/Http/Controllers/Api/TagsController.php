<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTagsRequest;
use App\Http\Requests\UpdateTagsRequest;
use App\Services\Tags\TagsInterface;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    protected $tags_interface;
    public function __construct(TagsInterface $tags_interface)
    {
        $this->tags_interface = $tags_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->tags_interface->index($params);     
    }
    public function details($id) {
        return $this->tags_interface->details($id);
    }
    public function create(CreateTagsRequest $request) {
        $params =  $request->all();
        return  $this->tags_interface->create($params);  
    }
    public function createMultiple(Request $request) {
        $params =  $request->all();
        return  $this->tags_interface->createMultiple($params);  
    }
    public function update(UpdateTagsRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->tags_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->tags_interface->delete($id);  
    }
}
