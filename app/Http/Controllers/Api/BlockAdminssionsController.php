<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlockAdminssionsRequest;
use App\Http\Requests\UpdateBlockAdminssionsRequest;
use App\Services\BlockAdminssions\BlockAdminssionsInterface;
use Illuminate\Http\Request;

class BlockAdminssionsController extends Controller
{
    protected $block_interface;
    public function __construct(BlockAdminssionsInterface $block_interface)
    {
        $this->block_interface = $block_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->block_interface->index($params);     
    }
    public function details($id) {
        return $this->block_interface->details($id);
    }
    public function create(CreateBlockAdminssionsRequest $request) {
        $params =  $request->all();
        return  $this->block_interface->create($params);  
    }
    public function createMultiple(Request $request) {        
        $params =  $request->all();
        return  $this->block_interface->createMultiple($params);  
    }
    
    public function update(UpdateBlockAdminssionsRequest $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->block_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->block_interface->delete($id);  
    }
}
