<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DegreeInformations extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'degree_informations';
    protected $fillable = [
        "id", "title","leads_id", "students_id", "type_id", "year_of_degree", "date_of_degree", "place_of_degree", "serial_number_degree", "status", "avatar", "created_at", "updated_at", "deleted_at", "created_by", "updated_by", "deleted_by"
    ];


    const CULTURAL_LEVEL_TITLE = 'TDVH';
    const PROFESSIONAL_LEVEL_TITLE = 'TDCM';
  
    const CONTACTS_MAP_ID = [
        self::CULTURAL_LEVEL_TITLE => 0,
        self::PROFESSIONAL_LEVEL_TITLE => 1,      
    ];
    const CONTACTS_MAP_TEXT = [
        self::CULTURAL_LEVEL_TITLE => "Trình độ văn hóa",
        self::PROFESSIONAL_LEVEL_TITLE => "Trình độ chuyên môn",      
    ];



    public function types() {
        return $this->belongsTo(EducationsTypes::class, 'type_id', 'id');
    }    
    public function leads() {
        return $this->belongsTo(Leads::class, 'leads_id', 'id');
    }   
    public function students() {
        return $this->belongsTo(Students::class, 'students_id', 'id');
    }   
}
