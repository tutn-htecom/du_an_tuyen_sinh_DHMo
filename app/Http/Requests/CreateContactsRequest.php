<?php

namespace App\Http\Requests;

use App\Models\Leads;
use App\Models\Students;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateContactsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {   
        return [              
            "provinces_name_hktt" => ['required', "min:4"," max: 255"],
            "districts_name_hktt" => ['required', "min:4"," max: 255"],
            "wards_name_hktt" => ['required', "min:4"," max: 255"],
            "address_hktt" => ['required', "min:4"," max: 255"],
            
            "provinces_name_dcll" => ['required', "min:4"," max: 255"],
            "districts_name_dcll" => ['required', "min:4"," max: 255"],
            "wards_name_dcll" => ['required', "min:4"," max: 255"],
            "address_dcll" => ['required', "min:4"," max: 255"]               
        ];
    }

    public function messages()
    {
        return [
            'provinces_name_hktt.required' => 'Vui lòng chọn Tỉnh / Thành phố',
            'provinces_name_hktt.min' => 'Độ dài của Tỉnh/ Thành Phố tối thiểu 4',
            'provinces_name_hktt.max' => 'Độ dài của Tỉnh/ Thành Phố tối đa 255',

            'districts_name_hktt.required' => 'Vui lòng chọn Quận / Huyện',
            'districts_name_hktt.min' => 'Độ dài của Quận / Huyện tối thiểu 4',
            'districts_name_hktt.max' => 'Độ dài của Quận / Huyện tối đa 255',

            'wards_name_hktt.required' => 'Vui lòng chọn Phường xã',
            'wards_name_hktt.min' => 'Độ dài của Phường / Xã tối thiểu 4',
            'wards_name_hktt.max' => 'Độ dài của Phường / Xã tối đa 255',

            'address_hktt.required' => 'Vui lòng nhập địa chỉ',
            'address_hktt.min' => 'Độ dài của địa chỉ tối thiểu 4',
            'address_hktt.max' => 'Độ dài của địa chỉ tối đa 255',  

            'provinces_name_dcll.required' => 'Vui lòng chọn Tỉnh / Thành phố',
            'provinces_name_dcll.min' => 'Độ dài của Tỉnh/ Thành Phố tối thiểu 4',
            'provinces_name_dcll.max' => 'Độ dài của Tỉnh/ Thành Phố tối đa 255',

            'districts_name_dcll.required' => 'Vui lòng chọn Quận / Huyện',
            'districts_name_dcll.min' => 'Độ dài của Quận / Huyện tối thiểu 4',
            'districts_name_dcll.max' => 'Độ dài của Quận / Huyện tối đa 255',

            'wards_name_dcll.required' => 'Vui lòng chọn Phường xã',
            'wards_name_dcll.min' => 'Độ dài của Phường / Xã tối thiểu 4',
            'wards_name_dcll.max' => 'Độ dài của Phường / Xã tối đa 255',

            'address_dcll.required' => 'Vui lòng nhập địa chỉ',
            'address_dcll.min' => 'Độ dài của địa chỉ tối thiểu 4',
            'address_dcll.max' => 'Độ dài của địa chỉ tối đa 255',  
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }
   
    // public function attributes(): array
    // {
    //     return [
    //         'HKTT.provinces_name' => "Tỉnh / Thành phố",
    //         'HKTT.districts_name' => "Quận / Huyện",
    //         '*.wards_name' => "Phường / Xã",
    //         '*.address' => "Địa chỉ",
    //         '*.home_phone' => "Số điện thoại nhà riêng",
    //         '*.personal_phone' => "Số điện thoại cá nhân",
    //     ];
    // }
}
