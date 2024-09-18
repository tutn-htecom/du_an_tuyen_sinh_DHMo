<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leads extends Model
{
    const FEMALE = 0;
    const MALE = 1;
    const ORTHER = 2;

    
    const APPLY_GENDER_NUMBER = [0,1,2];    
    const GENDER_MAP = [
        self::FEMALE => 'Nữ',
        self::MALE => 'Nam',
        self::ORTHER => 'Khác',
    ];
    const GENDER_MAP_TEXT = [
        self::FEMALE => 'Nữ',
        self::MALE => 'Nam',
        self::ORTHER => 'Khác',
    ];
    use SoftDeletes;
    use HasFactory;
    protected $table = 'leads';
    protected $fillable = [
        'id','full_name','code','email','phone','home_phone','avatar','date_of_birth','gender','identification_card','date_identification_card','place_identification_card','place_of_birth','place_of_wrk_lrn','sources_id','marjors_id','nations_name','ethnics_name','date_of_join_youth_union','date_of_join_communist_party',
        'company_name','company_address','lst_status_id','tags_id','remember_token','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by', 'assignments_id'
    ];
    public function create_by()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function update_by()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function delete_by()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function students()
    {
        return $this->belongsTo(Students::class, 'leads_id', 'id');
    }
    public function sources() {
        return $this->belongsTo(Sources::class, 'sources_id', 'id');
    }
    public function marjors() {
        return $this->belongsTo(Marjors::class, 'marjors_id', 'id');
    }
    public function status() {
        return $this->belongsTo(LstStatus::class, 'lst_status_id', 'id');
    }
    public function tags() {
        return $this->belongsTo(Tags::class, 'tags_id', 'id');
    }    
    public function contacts() {
        return $this->hasMany(Contacts::class, 'leads_id', 'id');
    }
    public function score() {
        return $this->hasMany(ScoreAdminssions::class, 'leads_id', 'id');
    } 
    public function files() {
        return $this->hasMany(Files::class, 'leads_id', 'id');
    } 
    public function supports() {
        return $this->hasMany(Supports::class, 'leads_id', 'id');
    } 
    public function family() {
        return $this->hasMany(FamilyInformations::class, 'leads_id', 'id');
    } 
    // Văn bằng tốt nghiệp
    public function degree() {
        return $this->hasMany(FamilyInformations::class, 'leads_id', 'id');
    }
    public function employees() {
        return $this->hasMany(FamilyInformations::class, 'assignments_id', 'id');
    }
    
}
