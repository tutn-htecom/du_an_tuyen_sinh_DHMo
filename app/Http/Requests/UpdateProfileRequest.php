<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {   
        return [                        
            'avatar' => ['required'],
            'date_of_birth' => ['required', 'date_format:d/m/Y',
            function ($attribute, $value, $fail) {                
                if (Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') >= date('Y-m-d')) {
                    $fail('Ngày sinh phải nhỏ hơn ngày hôm nay');
                }
            }],
            "place_of_birth"            => ['required'],
            "nations_name"              => ['required'],
            "ethnics_name"              => ['required'],
            'identification_card'       => ['required', 'size:12', 'unique:leads,identification_card,' . $this->id, 'regex:/^(\d{09}|\d{10}|\d{11}|\d{12})$/'],            
            'date_identification_card'  => ['required', 'date_format:d/m/Y',
                function ($attribute, $value, $fail) {
                    if (Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') >= date('Y-m-d')) {
                        $fail('Ngày cấp phải nhỏ hơn ngày hôm nay');
                    }
                }],
            "place_identification_card" => ['required'],
            "date_of_join_youth_union"  => ['nullable',
                function ($attribute, $value, $fail) {
                    if (Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') >= date('Y-m-d')) {
                        $fail('Ngày kết nạp đoàn phải nhỏ hơn ngày hôm nay');
                    }
            }],
            "date_of_join_communist_party"  => ['nullable',
                function ($attribute, $value, $fail) {
                    if (Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') >= date('Y-m-d')) {
                        $fail('Ngày vào đang phải nhỏ hơn ngày hôm nay');
                    }
            }],
            "email" => ['nullable', 'email'],

            "year_of_degree_tdvh" => ['nullable', 
                function ($attribute, $value, $fail) {
                if (Carbon::createFromFormat('Y', $value)->format('Y') > date('Y')) {
                $fail('Năm cấp bằng phải nhỏ hơn năm hiện tại');
                }
            }],
            "date_of_degree_tdvh" => ['nullable', 
                function ($attribute, $value, $fail) {
                    if (Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') > date('Y-m-d')) {
                        $fail('Ngày cấp bằng phải nhỏ hơn ngày hôm nay');
                    }
            }],          
            "year_of_degree_tdcm" => ['nullable', 
                function ($attribute, $value, $fail) {
                if (Carbon::createFromFormat('Y', $value)->format('Y') > date('Y')) {
                $fail('Năm cấp bằng phải nhỏ hơn năm hiện tại');
                }
            }],
            "date_of_degree_tdcm" => ['nullable', 
                function ($attribute, $value, $fail) {
                    if (Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') > date('Y-m-d')) {
                        $fail('Ngày cấp bằng phải nhỏ hơn ngày hôm nay');
                    }
            }],   
        ];
    }

    public function messages()
    {
        return [
            'avatar.required'               => 'Vui lòng chọn ảnh avatar',
            // Date Of Birthday.
            'date_of_birth.required'       => 'Vui lòng nhập ngày sinh',
            'date_of_birth.date_format'    => 'Ngày sinh không đúng định dạng d/m/Y',
            // CCCD
            'identification_card.required'  => 'Vui lòng nhập Căn cước công dân',
            'identification_card.size'      => 'Độ dài Căn cước công dân phải đúng 12 ký tự',
            'identification_card.regex'     => 'Căn cước công dân không đúng định dạng',
            'identification_card.unique'    => 'Căn cước công dân đã tồn tại trên hệ thống',
            // Date Of Birthday.
            'date_identification_card.required'       => 'Vui lòng nhập ngày cấp',
            'date_identification_card.date_format'    => 'Ngày sinh không đúng định dạng d/m/Y',
            'place_identification_card.required'      => 'Vui lòng nhập nơi cấp',
            'email.email'   => "Email không đúng định dạng",                             
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }
}
