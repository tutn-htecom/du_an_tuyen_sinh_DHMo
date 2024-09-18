<?php

namespace App\Http\Requests;

use App\Models\LstStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateStatusLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {        
        return [                        
            'lst_status_id' => ['required',  function ($attribute, $value, $fail) {     
                $model = LstStatus::where('id', $value)->first();
                if (!isset($model->id)) {
                    $fail('Trạng thái không tồn tại trên hệ thống');
                }
            }],           
        ];
    }

    public function messages()
    {
        return [
            'lst_status_id.required' => 'Vui lòng chọn trạng thái'            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }
}
