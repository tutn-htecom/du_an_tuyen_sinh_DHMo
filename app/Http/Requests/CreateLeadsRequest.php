<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Employees;
use App\Models\LstStatus;
use App\Models\Marjors;
use App\Models\Sources;

class CreateLeadsRequest extends FormRequest
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
            'family.*.full_name'        => ['required','max:255', 'min:4'],
            'family.*.phone_number'     => ['required','regex:/^(\d{10}|\d{11}|\d{12})$/', 'unique:family_informations,phone_number,' . $this->id],

            'contacts.*.provinces_name' => ['required','max:255', 'min:4'],
            'contacts.*.districts_name' => ['required','max:255', 'min:4'],
            'contacts.*.wards_name' => ['required','max:255', 'min:4'],
            'contacts.*.address' => ['required','max:255', 'min:4'],

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

            // Thông tin gia đình
            'family.*.full_name.required'       => 'Vui lòng nhập Họ và tên :attribute' ,
            'family.*.full_name.min'            => 'Thông tin phải có ít nhất 4 ký tự :attribute' ,
            'family.*.full_name.max'            => 'Thông tin phải có tối đa 255 ký tự :attribute' , 
            
            'family.*.phone_number.required'    => 'Vui lòng nhập Số điện thoại :attribute',
            'family.*.phone_number.unique'      => 'Số điện thoại đã tồn tại :attribute',
            'family.*.phone_number.regex'       => 'Số điện thoại không đúng định dạng :attribute' ,  
            
            // Thông tin liên lạc
            'contacts.*.provinces_name.required'=> 'Vui lòng nhập Tỉnh / Thành phố' ,
            'contacts.*.provinces_name.min'     => 'Độ dài Tỉnh / Thành phố tối thiểu 4 ký tự ',
            'contacts.*.provinces_name.max'     => 'Độ dài Tỉnh / Thành phố tối đa 255 ký tự ',

            'contacts.*.districts_name.required'=> 'Vui lòng nhập Quận / Huyện' ,
            'contacts.*.districts_name.min'     => 'Độ dài Quận / Huyện tối thiểu 4 ký tự',
            'contacts.*.districts_name.max'     => 'Độ dài Quận / Huyện tối đa 255 ký tự ',

            'contacts.*.wards_name.required'    => 'Vui lòng nhập Phường/ Xã' ,
            'contacts.*.wards_name.min'         => 'Độ dài Phường/ Xã tối thiểu 4 ký tự ',
            'contacts.*.wards_name.max'         => 'Độ dài Phường/ Xã tối đa 255 ký tự',

            'contacts.*.address.required'       => 'Vui lòng nhập Địa chỉ' ,
            'contacts.*.address.min'            => 'Độ dài địa chỉ tối thiểu 4 ký tự',
            'contacts.*.address.max'            => 'Độ dài địa chỉ tối đa 255 ký tự',            
        ];
    }

    protected function failedValidation(Validator $validator){
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([ 'code' => '422', 'data' => $errors ]));            
    }   
}
