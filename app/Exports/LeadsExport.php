<?php

namespace App\Exports;

use App\Repositories\LeadsRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;    
    public function __construct($data) {        
    	$this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }
        
    public function headings(): array {
        return [
            'STT',
            'Mã hồ sơ',
            'Họ và tên' ,        
            'Ngày sinh',
            'Số điện thoại',
            'Email',
            'Địa chỉ',
            'Tư vấn viên',
            'Trạng thái',
            'Nguồn MKT',
            'Thời gian',
            'Ngành học',
        ];
    }
    public function map($item):array{        
        
        GLOBAL $i;
        $contacts = null;
        $date_of_birth = null;
        $status = null;
        if(isset($item->contacts)) {
            $contacts = $item->contacts->where('leads_id', $item->id)->where('type', 0)->first();
        }
        if(isset($item->date_of_birth)) {            
            $date_of_birth = Carbon::createFromFormat('Y-m-d', $item->date_of_birth)->format('d/m/Y');            
        }        
        if(isset($item->lst_status_id)) {
            $status = $item->status->name;            
        }
        if(isset($item->lst_status_id)) {
            $sources_name = $item->sources->name;            
        }
        if(isset($item->lst_status_id)) {
            $marjors_name = $item->marjors->name;            
        }
        $i++;     
        $data = [
            $i,
            $item->code ?? null,
            $item->full_name ?? null,
            $date_of_birth,
            $item->phone ?? null,
            $item->email ?? null,
            $contacts['districts_name'] . ', '. $contacts['provinces_name'],
            $item->employees_id ?? 'Chưa có nhân viên tư vấn',        
            $status,
            $sources_name ?? "",
            Date('d/m/Y', strtotime($item->created_at)),            
            $marjors_name ?? "",
        ];            
        return $data;
    }
}
