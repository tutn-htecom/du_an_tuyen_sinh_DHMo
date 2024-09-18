<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyInformations extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'family_informations';
    protected $fillable = [
      'id','leads_id','students_id','type','title','full_name','year_of_birth','phone_number','jobs',
      'education_id','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];
    const FATHER = 'Cha';
    const MOTHER = 'Mẹ';
    const WIFE = 'Vợ';
    const HUSBAND = 'Chồng';
    const CHILD = 'Con';
    const FAMILY_MAP_ID = [
        self::FATHER => 0,
        self::MOTHER => 1,
        self::WIFE => 2,
        self::HUSBAND => 3,  
        self::CHILD => 4 
    ];
    const FAMILY_MAP_TEXT = [
        self::FATHER => "Thông tin cha",
        self::MOTHER => "Thông tin mẹ",
        self::WIFE => "Thông tin vợ",
        self::HUSBAND => "Thông tin chồng",  
        self::CHILD => "Thông tin con" 
    ];
    public function leads() {
        return $this->hasMany(Leads::class, 'leads_id', 'id');
    }
    public function students() {
        return $this->hasMany(Students::class, 'students_id', 'id');
    }    
    
}
