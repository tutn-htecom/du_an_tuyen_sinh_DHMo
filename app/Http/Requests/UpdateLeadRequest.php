<?php

namespace App\Http\Requests;


use App\Models\Employees;
use App\Models\LstStatus;
use App\Models\Marjors;
use App\Models\Sources;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {      
        return [                        
            'full_name'     => ['required','max:255', 'min:4'],     
            'phone'         => ['required','regex:/^(\d{10}|\d{11}|\d{12})$/', 'unique:leads,phone,' . $this->id],
            'email'         => ['required','max:255', 'email', 'unique:leads,email,' . $this->id],     
            'gender'        => ['required','regex:/^[012]+$/'],   
            'date_of_birth' => ['required', 'date_format:d/m/Y',
            function ($attribute, $value, $fail) {                
                if (Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') >= date('Y-m-d')) {
                    $fail('Ngày sinh phải nhỏ hơn ngày hôm nay');
                }
            }],
            'identification_card'       => ['required', 'size:12', 'unique:leads,identification_card,' . $this->id, 'regex:/^(\d{09}|\d{10}|\d{11}|\d{12})$/'],
            "lst_status_id" =>['nullable', function ($attribute, $value, $fail) {
                $status = LstStatus::where('id', $value)->first();
                if (!isset($status->id)) {
                    $fail('Trạng thái không tồn tại trên hệ thống');
                }
            }],
            "sources_id" =>['nullable', function ($attribute, $value, $fail) {
                $status = Sources::where('id', $value)->first();
                if (!isset($status->id)) {
                    $fail('Nguồn tiếp cận không tồn tại trên hệ thống');
                }
            }],

            "employees_id" =>['nullable', function ($attribute, $value, $fail) {
                $status = Employees::where('id', $value)->first();
                if (!isset($status->id)) {
                    $fail('Nhân viên không tồn tại trên hệ thống');
                }
            }],

            "marjors" =>['nullable', function ($attribute, $value, $fail) {
                $status = Marjors::where('id', $value)->first();
                if (!isset($status->id)) {
                    $fail('Chuyên ngành không tồn tại trên hệ thống');
                }
            }],
            'full_name_father'        => ['required','max:255', 'min:4'],            
            'phone_number_father'     => ['required','regex:/^(\d{10}|\d{11}|\d{12})$/'],
            'full_name_mother'        => ['required','max:255', 'min:4'],
            'phone_number_mother'     => ['required','regex:/^(\d{10}|\d{11}|\d{12})$/'],

            // Thông tin liên lạc
            'provinces_name_dcll' => ['required','max:255', 'min:4'],
            'districts_name_dcll' => ['required','max:255', 'min:4'],
            'wards_name_dcll' => ['required','max:255', 'min:4'],
            'address_dcll' => ['required','max:255', 'min:4'],
            // Hộ khẩu thường trú
            'provinces_name_hktt' => ['required','max:255', 'min:4'],
            'districts_name_hktt' => ['required','max:255', 'min:4'],
            'wards_name_hktt' => ['required','max:255', 'min:4'],
            'address_hktt' => ['required','max:255', 'min:4'],
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'        => 'Vui lòng nhập Họ và tên',
            'full_name.min'             => 'Họ và tên phải có ít nhất 4 ký tự',
            'full_name.max'             => 'Họ và tên phải có tối đa 255 ký tự',  
            
            'phone.required'            => 'Vui lòng nhập Số điện thoại',            
            'phone.unique'              => 'Số điện thoại đã tồn tại', 
            'phone.regex'               => 'Số điện thoại không đúng định dạng', 

            'email.required'            => 'Vui lòng nhập Email ',            
            'email.unique'              => 'Email này đã tồn tại', 
            'email.max'                 => 'Độ dài email tối đa 255 ký tự',  
            'email.email'               => 'Email không đúng định dạng',          
            'gender.required'           => 'Vui lòng nhập Giới tính ', 
            'gender.regex'              => 'Giá trị của giới tính thuộc 1 trong các giá trị [0, 1, 2]',    
            'date_of_birth.required'    => 'Vui lòng nhập ngày sinh',
            'date_of_birth.date_format' => 'Ngày sinh không đúng định dạng d/m/Y',
            
            // CCCD
            'identification_card.required'      => 'Vui lòng nhập Căn cước công dân',
            'identification_card.size'          => 'Độ dài Căn cước công dân phải đúng 12 ký tự',
            'identification_card.regex'         => 'Căn cước công dân không đúng định dạng',
            'identification_card.unique'        => 'Căn cước công dân đã tồn tại trên hệ thống',

            // Thông tin gia đình - Cha
            'full_name_father.required'       => 'Vui lòng nhập Họ và tên' ,
            'full_name_father.min'            => 'Thông tin phải có ít nhất 4 ký tự' ,
            'full_name_father.max'            => 'Thông tin phải có tối đa 255 ký tự' , 

            'phone_number_father.required'    => 'Vui lòng nhập Số điện thoại',
            // 'phone_number_father.unique'      => 'Số điện thoại đã tồn tại',
            'phone_number_father.regex'       => 'Số điện thoại không đúng định dạng' ,     
            
            // Thông tin gia đình - Mẹ
            'full_name_mother.required'       => 'Vui lòng nhập Họ và tên' ,
            'full_name_mother.min'            => 'Thông tin phải có ít nhất 4 ký tự' ,
            'full_name_mother.max'            => 'Thông tin phải có tối đa 255 ký tự' , 

            'phone_number_mother.required'    => 'Vui lòng nhập Số điện thoại',
            // 'phone_number_mother.unique'      => 'Số điện thoại đã tồn tại',
            'phone_number_mother.regex'       => 'Số điện thoại không đúng định dạng' ,  

            // Thông tin liên lạc - Hộ khẩu thường trú
            'provinces_name_hktt.required'=> 'Vui lòng nhập Tỉnh / Thành phố' ,
            'provinces_name_hktt.min'     => 'Độ dài Tỉnh / Thành phố tối thiểu 4 ký tự ',
            'provinces_name_hktt.max'     => 'Độ dài Tỉnh / Thành phố tối đa 255 ký tự ',

            'districts_name_hktt.required'=> 'Vui lòng nhập Quận / Huyện' ,
            'districts_name_hktt.min'     => 'Độ dài Quận / Huyện tối thiểu 4 ký tự',
            'districts_name_hktt.max'     => 'Độ dài Quận / Huyện tối đa 255 ký tự ',

            'wards_name_hktt.required'    => 'Vui lòng nhập Phường/ Xã' ,
            'wards_name_hktt.min'         => 'Độ dài Phường/ Xã tối thiểu 4 ký tự ',
            'wards_name_hktt.max'         => 'Độ dài Phường/ Xã tối đa 255 ký tự',

            'address_hktt.required'       => 'Vui lòng nhập Địa chỉ' ,
            'address_hktt.min'            => 'Độ dài địa chỉ tối thiểu 4 ký tự',
            'address_hktt.max'            => 'Độ dài địa chỉ tối đa 255 ký tự',  
            
            // Thông tin liên lạc - Địa chỉ liên lạc
            'provinces_name_dcll.required'=> 'Vui lòng nhập Tỉnh / Thành phố' ,
            'provinces_name_dcll.min'     => 'Độ dài Tỉnh / Thành phố tối thiểu 4 ký tự ',
            'provinces_name_dcll.max'     => 'Độ dài Tỉnh / Thành phố tối đa 255 ký tự ',

            'districts_name_dcll.required'=> 'Vui lòng nhập Quận / Huyện' ,
            'districts_name_dcll.min'     => 'Độ dài Quận / Huyện tối thiểu 4 ký tự',
            'districts_name_dcll.max'     => 'Độ dài Quận / Huyện tối đa 255 ký tự ',

            'wards_name_dcll.required'    => 'Vui lòng nhập Phường/ Xã' ,
            'wards_name_dcll.min'         => 'Độ dài Phường/ Xã tối thiểu 4 ký tự ',
            'wards_name_dcll.max'         => 'Độ dài Phường/ Xã tối đa 255 ký tự',

            'address_dcll.required'       => 'Vui lòng nhập Địa chỉ' ,
            'address_dcll.min'            => 'Độ dài địa chỉ tối thiểu 4 ký tự',
            'address_dcll.max'            => 'Độ dài địa chỉ tối đa 255 ký tự',       
                    ];
    }

    protected function failedValidation(Validator $validator){
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }   
}
