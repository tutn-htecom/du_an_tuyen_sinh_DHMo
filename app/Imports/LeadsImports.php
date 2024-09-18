<?php

namespace App\Imports;

use App\Models\Employees;
use App\Models\Leads;
use App\Models\LstStatus;
use App\Models\Marjors;
use App\Models\Sources;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;


// WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithChunkReading, ShouldQueue, WithEvents
class LeadsImports implements ToCollection, WithStartRow

// , WithValidation
{
    use Importable;
    public function startRow(): int
    {
        return 4;
    }

    public function collection(Collection $rows)
    {        
        try {
            DB::beginTransaction();
            $result = null;    
            $dem = 0;                  
            foreach ($rows as $key => $row) {
                $password       = Str::random(16);
                $date_of_birth  = strlen(trim($row[1])) ? Carbon::createFromFormat('d/m/Y', trim($row[2]))->format('Y-m-d') : null;
                $assignments    = Employees::where('name',  'LIKE', '%'.trim($row[8]).'%')->first(); 
                $status         = LstStatus::where('name',  'LIKE', '%'.trim($row[9]).'%')->first();
                $sources        = Sources::where('name',  'LIKE', '%'.trim($row[10]).'%')->first();
                $marjors        = Marjors::where('name', 'LIKE', '%'.trim($row[11]).'%')->first();  
                $data = [
                    "full_name"             => trim($row[1]) ?? null,
                    "code"                  => "TS" . rand(100000, 999999) ?? null,
                    "date_of_birth"         => $date_of_birth ?? null,
                    "phone"                 => trim($row[3]) ?? null,
                    "home_phone"            => trim($row[4]) ?? null,
                    "identification_card"   => trim($row[5]) ?? null,
                    "gender"                => Leads::FEMALE ==  trim($row[6]) ? Leads::FEMALE : (Leads::MALE ==  trim($row[6]) ? Leads::MALE : Leads::ORTHER) ?? null,
                    "email"                 => trim($row[7]) ?? null,                
                    "assignments_id"        => $assignments->id ?? null,
                    "lst_status_id"         => $status->id ?? null,
                    "sources_id"            => $sources->id ?? null,
                    "marjors_id"            => $marjors->id ?? null,
                    "created_by"            => Auth::user()->id ?? null,
                    // "tags_id"               => $tags->id ?? null,
                    "place_of_birth"        => trim($row[14]) ?? null,
                    "place_of_wrk_lrn"      => trim($row[15]) ?? null,           
                ];                                 
                $model = Leads::create($data);                              
                if(isset($model->id)) $dem += 1;
            }              
            if($dem > 0 ) {
                $result = [
                    "code"      => 200,
                    "message"   => "Import File thành công",
                    "total"     => $dem
                ];
            } else {
                $result = [
                    "code"      => 422,
                    "message"   => "Import File không thành công"
                ];
            }     
            DB::commit();                   
            return $result;       
           
        } catch (\Exception $e) {                    
            DB::rollback();
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return [
                "code" => 422,
                "message" => $e->getMessage()
            ];
        }
    }
    public function rules(): array
    {   
        return [
            'full_name' => ['required','max:255', 'min:8'],
            // '*.email' => ['required','max:255', 'min:8', 'email', 'unique:leads,email'],                       
            // 'date_of_birth' => ['required', 'date_format:d/m/Y',
            // function ($attribute, $value, $fail) {
            //     if (date('d/m/Y', strtotime($value)) >= date('d/m/Y')) {
            //         $fail('Ngày sinh phải nhỏ hơn ngày hôm nay');
            //     }
            // }],
            // 'gender'                => ['required', 'regex:/^[012]+$/'],
            // 'phone'                 => ['required', 'min: 10', 'max:12', 'regex:/^(\d{10}|\d{11}|\d{12})$/', 'unique:leads,phone'],
            // 'home_phone'            => ['nullable', 'min: 10', 'max:12', 'regex:/^(\d{09}|\d{10}|\d{11}|\d{12})$/', 'unique:leads,home_phone'],
            // 'identification_card'   => ['required', 'size:12', 'unique:leads,identification_card', 'regex:/^(\d{09}|\d{10}|\d{11}|\d{12})$/'],
            // 'place_of_birth'        => ['required'],
            // 'place_of_wrk_lrn'      => ['required'],
            // 'sources_id'            => ['required'],
            // 'marjors_id'            => ['required'],
        ];
    }
    public function customValidationMessages()
    {        
        return [
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
}
