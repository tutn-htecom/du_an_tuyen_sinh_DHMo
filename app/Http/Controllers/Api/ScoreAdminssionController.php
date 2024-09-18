<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateScoreAdminssionRequest;
use App\Services\ScoreAdminssions\ScoreAdminssionsInterface;
use Illuminate\Http\Request;

class ScoreAdminssionController extends Controller
{
    protected $score_interface;
    public function __construct(ScoreAdminssionsInterface $score_interface)
    {
        $this->score_interface = $score_interface;
    }

    public function index(Request $request){
        $params =  $request->all();  
        return  $this->score_interface->index($params);     
    }
    public function details($id) {
        return $this->score_interface->details($id);
    }
    public function create(CreateScoreAdminssionRequest $request) {
        $params =  $request->all();        
        return  $this->score_interface->create($params);  
    }
    public function createMultiple(Request $request) {
        $params =  $request->all();
        return  $this->score_interface->createMultiple($params);  
    }
    public function update(Request $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->score_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->score_interface->delete($id);  
    }
}
