<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationsTypes extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'educations_types';
    protected $fillable = [
        'id','name','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];

    public function degree() {
        return $this->hasMany(DegreeInformations::class, 'type_id', 'id');
    }
    public function family() {
        return $this->hasMany(FamilyInformations::class, 'type_id', 'id');
    }
}
