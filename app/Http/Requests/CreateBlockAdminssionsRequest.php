<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBlockAdminssionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {        
        return [                        
            'name' => ['required','max:255', 'min:4'],
            'code' => ['required','max:255', 'unique:block_adminssions,code'],
            'subject' => ['required','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên Tổ hợp môn',
            'name.min' => 'Tên Tổ hợp môn phải có ít nhất 4 ký tự',
            'name.max' => 'Tên Tổ hợp môn phải có tối đa 255 ký tự',   
            
            'code.required' => 'Vui lòng nhập đầy đủ Mã Tổ hợp môn',
            'code.min' => 'Mã Tổ hợp môn phải có ít nhất 4 ký tự',
            'code.max' => 'Mã Tổ hợp môn phải có tối đa 255 ký tự',     
            'code.unique' => 'Mã Tổ hợp môn đã tồn tại',     

            'subject.required' => 'Vui lòng nhập đầy đủ Môn xét tuyển',            
            'subject.max' => 'Môn xét tuyển phải có tối đa 255 ký tự',     
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }
}
