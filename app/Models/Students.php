<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use SoftDeletes;
    use HasFactory;
    const FEMALE = 0;
    const MALE = 1;
    const ORTHER = 2;
    const APPLY_GENDER_NUMBER = [0,1,2];    
    const GENDER_MAP = [
        self::FEMALE => 'Nữ',
        self::MALE => 'Nam',
        self::ORTHER => 'Khác',
    ];

    protected $table = 'leads';
    protected $fillable = [
        'id','full_name','code','email','phone','avatar','date_of_birth','gender','identification_card','date_identification_card','place_identification_card','place_of_birth','place_of_wrk_lrn','sources_id','marjors_id',
        'nations_name','ethnics_name','date_of_join_youth_union','date_of_join_communist_party','company_name','company_address','status_id','tags_id','remember_token','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];

    public function sources() {
        return $this->belongsTo(Sources::class, 'sources_id', 'id');
    }
    public function marjors() {
        return $this->belongsTo(Marjors::class, 'marjors_id', 'id');
    }
    public function status() {
        return $this->belongsTo(LstStatus::class, 'status_id', 'id');
    }
    public function tags() {
        return $this->belongsTo(Tags::class, 'tags_id', 'id');
    }    
    public function contacts() {
        return $this->hasMany(Contacts::class, 'students_id', 'id');
    }    
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function leads()
    {
        return $this->belongsTo(Leads::class, 'leads_id', 'id');
    }
}
