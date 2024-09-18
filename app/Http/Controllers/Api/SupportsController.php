<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMultipleSupportsRequest;
use App\Http\Requests\CreateSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Services\Supports\SupportsInterface;
use Illuminate\Http\Request;


class SupportsController extends Controller
{
    protected $support_interface;
    public function __construct(SupportsInterface $support_interface) {
        $this->support_interface = $support_interface;
    }

    public function index(Request $request) {
        $params = $request->all();
        return $this->support_interface->index($params);
    }

    public function details($id) {        
        return $this->support_interface->details($id);
    }

    public function create(CreateSupportRequest $request){                
        $params = $request->all();        
        return $this->support_interface->create($params);
    }

    public function createMultiple(CreateMultipleSupportsRequest $request){  
        $params = $request->all();        
        return $this->support_interface->createMultiple($params);
    }

    public function update(UpdateSupportRequest $request, $id){            
        $params = $request->all();        
        return $this->support_interface->update($params, $id);
    }

    public function delete($id){                           
        return $this->support_interface->delete($id);
    }
}
