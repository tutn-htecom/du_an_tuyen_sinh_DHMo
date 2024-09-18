<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LstStatus extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'lst_status';
    protected $fillable = [
        'id','name','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];
    public function leads() {
        return $this->hasMany(Leads::class, 'lst_status_id', 'id');
    }
    public function students() {
        return $this->hasMany(Students::class, 'lst_status_id', 'id');
    }
}
