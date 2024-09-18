<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {        
        return [                        
            'image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],         
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Vui lòng chọn ảnh đại diện',            
            'image.max'      => 'Thông tin phải có tối đa 255 ký tự',              
            'image.image'    => 'File tải lên không phải là ảnh',
            'image.mimes'    => 'File ảnh không đúng định dạng'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }
}
