<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Employees\EmployeesInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employees_interface;
    public function __construct(EmployeesInterface $employees_interface)
    {
        $this->employees_interface = $employees_interface;
    }

    public function index(Request $request){        
        $params =  $request->all();  
        return  $this->employees_interface->index($params);     
    }
    public function details($id) {
        return $this->employees_interface->details($id);
    }
    public function create(Request $request) {           
        $params =  $request->all();
        return  $this->employees_interface->create($params);  
    }

    public function update(Request $request, $id) {
        if(!isset($id)) {           
            return [
                "code" => 422,
                "message" => "Vui lòng chọn bản ghi",
            ];
        }                
        $params = $request->all();        
        return  $this->employees_interface->update($params, $id);  
    }
    public function delete($id) {        
        return  $this->employees_interface->delete($id);  
    }
}
