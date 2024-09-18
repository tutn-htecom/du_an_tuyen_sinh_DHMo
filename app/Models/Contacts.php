<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = [
        'id','type','title','leads_id','students_id','provinces_name','districts_name','wards_name','address',
        'personal_phone','home_phone','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];
    const CONTACT_ADDRESS_TITLE = 'DCLL';
    const PERMANENT_RESIDENCE_TITLE = 'HKTT';
  
    const CONTACTS_MAP_ID = [
        self::CONTACT_ADDRESS_TITLE => 0,
        self::PERMANENT_RESIDENCE_TITLE => 1,      
    ];
    const CONTACTS_MAP_TEXT = [
        self::CONTACT_ADDRESS_TITLE => "Địa chỉ liên lạc",
        self::PERMANENT_RESIDENCE_TITLE => "Hộ khẩu thường trú",      
    ];
    public function leads() {
        return $this->belongsTo(Leads::class, 'leads_id', 'id');
    }
    public function students() {
        return $this->belongsTo(Students::class, 'students_id', 'id');
    }  
}
