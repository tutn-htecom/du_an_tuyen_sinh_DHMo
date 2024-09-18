<?php

namespace App\Http\Requests;

use App\Models\Employees;
use App\Models\Leads;
use App\Models\Students;
use App\Models\Tags;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSupportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {        
        return [                        
            'leads_id' => ['nullable', 
            function ($attribute, $value, $fail) {     
                $model = Leads::where('id', $value)->first();
                if (!isset($model->id)) {
                    $fail('Thí sinh này không tồn tại trên hệ thống');
                }
            }],  
            'students_id' => ['nullable', 
            function ($attribute, $value, $fail) {     
                $model = Students::where('id', $value)->first();
                if (!isset($model->id)) {
                    $fail('Thí sinh này không tồn tại trên hệ thống');
                }
            }],
            'tags_id' => ['nullable', 
            function ($attribute, $value, $fail) {     
                $model = Tags::where('id', $value)->first();
                if (!isset($model->id)) {
                    $fail('Thẻ này này không tồn tại trên hệ thống');
                }
            }],  
            'employees_id' => ['nullable', 
            function ($attribute, $value, $fail) {                  
                $model = Employees::where('id', $value)->first();
                if (!isset($model->id)) {
                    $fail('Nhân viên không tồn tại trên hệ thống');
                }
            }],  
            "subject"=> ['required', "max:255", 'min:4'],
            "descriptions"  => ['required'],   
            "send_to"       => ['nullable', 'email'],
            "send_cc"       => ['nullable', 'email']
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Vui lòng nhập đầy đủ thông tin',
            'subject.min' => 'Thông tin phải có ít nhất 4 ký tự',
            'subject.max' => 'Thông tin phải có tối đa 255 ký tự',              
            'descriptions.required' => 'Thông tin đã tồn tại trên hệ thống',  
            'send_to.email' => 'mail đến chưa đúng định dạng',  
            'send_cc.email' => 'mail này chưa đúng định dạng'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }
}
