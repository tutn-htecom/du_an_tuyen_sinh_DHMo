<?php

namespace App\Imports;

use App\Models\Employees;
use App\Models\Leads;
use App\Models\LstStatus;
use App\Models\Marjors;
use App\Models\Sources;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class LeadsImport implements ToModel, WithStartRow
{    
    protected $leads_repository;
    // ToModel
    public function startRow(): int
    {
        return 4;
    }

    public function model(array $row)
    {
        try {
            $params["password"] = Str::random(16);
            $date_of_birth  = strlen(trim($row[1])) ? Carbon::createFromFormat('d/m/Y', trim($row[2]))->format('Y-m-d') : null;
            $assignments    = Employees::where('name',  'LIKE', '%' . trim($row[8]) . '%')->first();
            $status         = LstStatus::where('name',  'LIKE', '%' . trim($row[9]) . '%')->first();
            $sources        = Sources::where('name',  'LIKE', '%' . trim($row[10]) . '%')->first();
            $marjors        = Marjors::where('name', 'LIKE', '%' . trim($row[11]) . '%')->first();
            // $tags           = Tags::where('name', 'LIKE', '%'.trim($row[13]).'%')->first();
            return new Leads([
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
                // "tags_id"            => $tags->id ?? null,
                "place_of_birth"        => trim($row[14]) ?? null,
                "place_of_wrk_lrn"      => trim($row[15]) ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('Thông báo lỗi: ' . $e->getMessage());
            return [
                "code" => 422,
                "message" => $e->getMessage()
            ];
        }
    }
   
}
