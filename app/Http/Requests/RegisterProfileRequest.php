<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {       
        return [                        
            // 'password' => ['required', 'min:8', 'regex:/(?=^.{8,16}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/' ],
            'email' => ['required','max:255', 'min:8', 'email', 'unique:leads,email'],            
            'full_name' => ['required','max:255', 'min:8'],
            'date_of_birth' => ['required', 'date_format:d/m/Y',
            function ($attribute, $value, $fail) {
                if (date('d/m/Y', strtotime($value)) >= date('d/m/Y')) {
                    $fail('Ngày sinh phải nhỏ hơn ngày hôm nay');
                }
            }],
            'gender'                => ['required', 'regex:/^[012]+$/'],
            'phone'                 => ['required', 'min: 10', 'max:12', 'regex:/^(\d{10}|\d{11}|\d{12})$/', 'unique:leads,phone'],
            'home_phone'            => ['nullable', 'min: 10', 'max:12', 'regex:/^(\d{09}|\d{10}|\d{11}|\d{12})$/', 'unique:leads,home_phone'],
            'identification_card'   => ['required', 'size:12', 'unique:leads,identification_card', 'regex:/^(\d{09}|\d{10}|\d{11}|\d{12})$/'],
            'place_of_birth'        => ['required'],
            'place_of_wrk_lrn'      => ['required'],
            'sources_id'            => ['required'],
            'marjors_id'            => ['required'],
        ];
    }

    public function messages()
    {
        return [
            // Email
            'email.required'        => 'Vui lòng nhập đầy đủ Email',
            'email.min'             => 'Email phải có ít nhất 8 ký tự',
            'email.max'             => 'Email phải có tối đa 255 ký tự',
            'email.email'           => 'Email không đúng định dạng',            
            'email.unique'          => 'Email đã tồn tại trên hệ thống',   
            // Full Name
            'full_name.required'    => 'Vui lòng nhập đầy đủ Họ và tên',
            'full_name.min'         => 'Độ dài tối thiểu 8 ký tự',
            'full_name.max'         => 'Độ dài tối đa 255 ký tự',
            'full_name.regex'       => 'Họ và tên chứa ký tự đặc biệt',
            // Date Of Birthday.
            'date_of_birth.required'    => 'Vui lòng nhập ngày sinh',
            'date_of_birth.date_format' => 'Ngày sinh không đúng định dạng d/m/Y',
            
            // Gender
            'gender.required'       => 'Vui lòng chọn giới tính',
            'gender.regex'          => 'Giá trị của giới tính thuộc 1 trong các giá trị [0, 1, 2]',   
            // Phone 
            'phone.required'        => 'Vui lòng nhập số điện thoại',
            'phone.min'             => 'Độ dài tối thiểu 10 ký tự',
            'phone.max'             => 'Độ dài tối đa 12 ký tự',
            'phone.regex'           => 'Số điện thoại không đúng định dạng',
            'phone.unique'          => 'Số điện thoại đã tồn tại trên hệ thống',
            // HOme phone
            'home_phone.min'        => 'Độ dài tối thiểu 10 ký tự',
            'home_phone.max'        => 'Độ dài tối đa 12 ký tự',
            'home_phone.regex'      => 'Số điện thoại không đúng định dạng',
            'home_phone.unique'     => 'Số điện thoại đã tồn tại trên hệ thống',

            // CCCD
            'identification_card.required'  => 'Vui lòng nhập Căn cước công dân',           
            'identification_card.size'      => 'Độ dài Căn cước công dân phải đúng 12 ký tự',
            'identification_card.regex'     => 'Căn cước công dân không đúng định dạng',
            'identification_card.unique'    => 'Căn cước công dân đã tồn tại trên hệ thống',
            // Thông tin khác
            'place_of_birth.required'       => 'Vui lòng chọn Nơi sinh',
            'place_of_wrk_lrn.required'     => 'Vui lòng nhập Nơi đang làm việc / học tập',
            'sources_id.required'           => 'Vui lòng chọn Nguồn tiếp cận',
            'marjors_id.required'           => 'Vui lòng chọn ngành đăng ký'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors  ])); 
    }
}
