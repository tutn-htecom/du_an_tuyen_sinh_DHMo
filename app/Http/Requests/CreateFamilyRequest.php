<?php

namespace App\Http\Requests;

use App\Models\FamilyInformations;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateFamilyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {   
        return [                        
            'full_name_father' => ['required', 'max:255'],
            'phone_number_father' => ['required', 'min: 10', 'max:12', 'unique:family_informations,phone_number'],
            'year_of_birth_father'=> ['nullable', 
                function ($attribute, $value, $fail) {                
                    if (Carbon::createFromFormat('Y', $value)->format('Y') >= date('Y')) {
                        $fail('năm sinh phải nhỏ hơn ngày hôm nay');
                    }
            }],
            'full_name_mother' => ['required', 'max:255'],
            'phone_number_mother' => ['required', 'max:255', 'unique:family_informations,phone_number'],
            'year_of_birth_mother'=> ['nullable', 
                function ($attribute, $value, $fail) {                
                    if (Carbon::createFromFormat('Y', $value)->format('Y') >= date('Y')) {
                        $fail('Năm sinh phải nhỏ hơn năm hiện tại');
                    }
            }],
            
            'full_name_wife' => ['nullable', 'max:255'],
            'phone_number_wife' => ['nullable', 'max:255', 'unique:family_informations,phone_number'],
            'year_of_birth_wife'=> ['nullable', 
                function ($attribute, $value, $fail) {                
                    if (Carbon::createFromFormat('Y', $value)->format('Y') >= date('Y')) {
                        $fail('Năm sinh phải nhỏ hơn năm hiện tại');
                    }
            }],
        ];
    }
// 'min: 10', 'max:12',
    public function messages()
    {
        return [
            "full_name_father.required" => "Vui lòng nhập Họ và tên Cha",
            "full_name_mother.required" => "Vui lòng nhập Họ và tên Mẹ",
            "full_name_wife.required"   => "Vui lòng nhập họ và tên Vợ",

            "full_name_father.max" => "Độ dài của số điện thoại tối đa 255 ký tự",
            "full_name_mother.max" => "Độ dài của số điện thoại tối đa 255 ký tự",
            "full_name_wife.max"   => "Độ dài của số điện thoại tối đa 255 ký tự",

            // Số điện thoại
            "phone_number_father.required" => "Vui lòng nhập Số điện thoại Cha",
            "phone_number_mother.required" => "Vui lòng nhập Số điện thoại Mẹ",
            "phone_number_wife.required"   => "Vui lòng nhập Số điện thoại Vợ",

            "phone_number_father.min" => "Độ dài của số điện thoại tối thiểu 10 ký tự",
            "phone_number_mother.min" => "Độ dài của số điện thoại tối thiểu 10 ký tự",
            "phone_number_wife.min"   => "Độ dài của số điện thoại tối thiểu 10 ký tự",

            "phone_number_father.max" => "Độ dài của số điện thoại tối đa 12 ký tự",
            "phone_number_mother.max" => "Độ dài của số điện thoại tối đa 12 ký tự",
            "phone_number_wife.max"   => "Độ dài của số điện thoại tối đa 12 ký tự",

            "phone_number_father.unique" => "Số điện thoại đã tồn tại",
            "phone_number_mother.unique" => "Số điện thoại đã tồn tại",
            "phone_number_wife.unique"   => "Số điện thoại đã tồn tại",
            
            
            


        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }

  
}
