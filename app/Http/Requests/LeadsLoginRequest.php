<?php

namespace App\Http\Requests;

use App\Traits\General;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadsLoginRequest extends FormRequest
{
    use General;
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [                        
            'email' => ['required','max:255', 'min:4', 'email', 'regex:/^^[a-zA-Z0-9.]+@[a-zA-Z.]+\.[a-zA-Z]{2,}$/'],            
            'password' => ['required', 'min:8', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập Email',
            'email.min' => 'Email phải có ít nhất 4 ký tự',
            'email.max' => 'Email phải có tối đa 255 ký tự',
            'email.email' => 'Email không đúng định dạng',            
            'email.regex' => 'Email chưa ký tự đặc biệt',            
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có tối thiểu 8 ký tự',                        
            'password.max' => 'Mật khẩu phải có tối đa 255 ký tự',                        
            'password.regex' => 'Vui lòng nhập mật khẩu mạnh',            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors  ]));            
    }
}
