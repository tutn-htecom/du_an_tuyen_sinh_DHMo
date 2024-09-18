<?php

namespace App\Services\Supports;

use App\Models\Supports;
use App\Repositories\SupportsRepository;
use App\Services\Supports\SupportsInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupportsServices implements SupportsInterface
{    
    protected $sp_repository;
    public function __construct(SupportsRepository $sp_repository) {
      $this->sp_repository = $sp_repository;   
    }
    public function index($params){
        try {
            $model = $this->sp_repository;
            if (isset($params['name'])) {
                $model = $model->where('name', 'like', '%' . $params['name'] . '%');
            }
            $model = $model->orderBy('id', 'desc')->get()->toArray();
            if (count($model) > 0) {
                $result = [
                    "code" => 200,
                    "data" => $model
                ];
            } else {
                $result = [
                    "code" => 422,
                    "message" => "Hệ thống chưa có bản ghi nào"
                ];
            }
            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage() . ' tại dòng số: ' . $e->getMessage());
            return response()->json(['message' => 'Hệ thống chưa có bản ghi nào'], 404);
        }
    }
    public function details($id) {
        try {
            $model = $this->sp_repository->where('id', $id)->first();
            if (isset($model->id)) {
                $result = [
                    "code" => 200,
                    "data" => $model
                ];
            } else {
                $result = [
                    "code" => 422,
                    "message" => "Hệ thống chưa có bản ghi nào"
                ];
            }
            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage() . ' tại dòng số: ' . $e->getMessage());
            return response()->json(['message' => 'Hệ thống chưa có bản ghi nào'], 404);
        }
    }
    public function create($params) {        
        try {
            $params['code'] = rand(1,999999);           
            $model =  $this->sp_repository->create($params);
            if(isset($model->id)) {
                return response()->json([
                    "code"      => 200,
                    "message"   => "Thêm mới yêu cầu hỗ trợ thành công",
                    "data"      => $model
                ]); 
            } else {
                return response()->json([
                    "code"      => 422,
                    "message"   => "Thêm mới yêu cầu hỗ trợ không thành công",                    
                ]); 
            }           
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage() . ' tại dòng số: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]); 
        }
    }    
    public function createMultiple($params) {        
        try {
            $data = [];
            foreach ($params as $item) {               
                $item['created_by'] = Auth::user()->id ?? null;
                $item['code'] = rand(1,999999);      
                $data[] = $item;
            }                 
            $model =  $this->sp_repository->createMultiple($data);
            if(count($model) > 0) {
                return response()->json([
                    "code"      => 200,
                    "message"   => "Thêm mới yêu cầu hỗ trợ thành công",
                    "data"      => $model
                ]); 
            } else {
                return response()->json([
                    "code"      => 422,
                    "message"   => "Thêm mới yêu cầu hỗ trợ không thành công",                    
                ]); 
            }
           
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage() . ' tại dòng số: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]); 
       }
    }    
    public function update($params, $id) {                     
        try {
            $model = $this->sp_repository->where('id', $id)->updateById($id, $params);
            if(isset($model->id)) {                
                return response()->json([
                    "code" => 200,
                    "message" => "Cập nhật phiếu yêu cầu thành công"
                ]);  
            } else {
                return response()->json([
                    "code" => 422,
                    "message" => "Không tìm thấy phiếu yêu cầu hỗ trợ này"
                ]);     
            }        
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage() . ' tại dòng số: ' . $e->getMessage());
            return response()->json([
                "code" => 422,
                "message" => $e->getMessage()
            ]); 
        }
    }
    public function delete($id) {
        $model = $this->sp_repository->where('id', $id)->deleteById($id);
        if($model  == true) {                
            return response()->json([
                "code" => 200,
                "message" => "Xóa phiếu yêu cầu thành công"
            ]);  
        } else {
            return response()->json([
                "code" => 422,
                "message" => "Xóa phiếu yêu cầu thất bại"
            ]);     
        }       
    }
}
