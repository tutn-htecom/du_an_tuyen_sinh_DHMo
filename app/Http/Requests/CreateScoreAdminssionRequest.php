<?php

namespace App\Http\Requests;

use App\Models\BlockAdminssions;
use App\Models\FormAdminssions;
use App\Models\Leads;
use App\Models\Marjors;
use App\Models\MethodAdminssions;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateScoreAdminssionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {   
        $rules = [
            // hình thức tuyển sinh
            "form_adminssions_id" => ['required', function ($attribute, $value, $fail) {     
                $model = FormAdminssions::where('id', $value)->first();
                if (!isset($model->id)) {
                    $fail('Hình thức chọn không tồn tại trên hệ thống');
                }
            }],                      
            "province_name" => ['required'],
            "school_name" => ['required'],
            "marjors_id" => ['required', function ($attribute, $value, $fail) {     
                $model = Marjors::where('id', $value)->first();
                if (!isset($model->id)) {
                    $fail('Ngành chọn không tồn tại trên hệ thống');
                }
            }], 
            
        ];

        // Kiểm tra điều kiện chọn phương thức để validate
        if($this->method_adminssions_id != "") 
        {
            $method = MethodAdminssions::select('id', 'name')->where('id', $this->method_adminssions_id)->first();  
             
            if(isset($method->id)){
                if($method->id == config('app.data.request.academic_transcript_id') || $method->name == config('app.data.request.academic_transcript')) {
                    $rules['block_adminssions_id']  = ['required', function ($attribute, $value, $fail) {     
                        $model = BlockAdminssions::where('id', $value)->first();
                        if (!isset($model->id)) {
                            $fail('Tổ hợp môn chọn không tồn tại trên hệ thống');
                        }
                    }];
                    $rules['score1']  = ['required', 'numeric'];
                    $rules['score2']  = ['required', 'numeric'];
                    $rules['score3']  = ['required', 'numeric'];                    
                }
                if($method->id == config('app.data.request.university_transcript_id') || $method->name == config('app.data.request.university_transcript')) {
                    $rules["score_avg"] = ['required', 'numeric'];
                }         
            } else {  
                if($this->method_adminssions_id)          
                $rules['method_adminssions_id'] = [
                        function ($attribute, $value, $fail) {     
                            $fail('Phương thức chọn không tồn tại');
                        }
                ];         
            }
        } else {
            $rules ["method_adminssions_id"] = ['required'];
        }        
        return $rules;
    }

    public function messages()
    {
        return [
            'block_adminssions_id.required'         => "Vui lòng chọn tổ hợp môn",
            'leads_id.required'                     => 'Vui lòng chọn thí sinh cần xét tuyển',            
            'form_adminssions_id.required'          => 'Vui lòng chọn hình thức xét tuyển',  
            'method_adminssions_id.required'        => 'Vui lòng chọn phương thức xét tuyển',  
            'province_name.required'                => 'Vui lòng chọn Tỉnh/ Thành Phố xét tuyển',  
            'school_name.required'                  => 'Vui lòng chọn Trường cần xét tuyển',  
            'marjors_id.required'                   => 'Vui lòng chọn Ngành cần xét tuyển',
            'score1.required'                       => 'Vui lòng nhập điểm của môn thứ nhất',
            'score2.required'                       => 'Vui lòng nhập điểm của môn thứ hai',
            'score3.required'                       => 'Vui lòng nhập điểm của môn thứ ba',
            'score1.numeric'                        => 'Điểm của môn thứ nhất phải là dạng số',
            'score2.numeric'                        => 'Điểm của môn thứ hai phải là dạng số',
            'score3.numeric'                        => 'Điểm của môn thứ ba phải là dạng số',
            'score_avg.required'                    => 'Vui lòng nhập điểm trung bình',
            'score_avg.numeric'                     => 'Điểm trung bình không đúng định dạng số',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }
}
