<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supports extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'supports';
    protected $fillable = [
        'id','code','leads_id','students_id','subject','descriptions','tags_id','employees_id','send_to','send_cc',
        'sp_status_id','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];
 
    public function leads() {
        return $this->belongsTo(Leads::class, 'leads_id', 'id');
    }
    public function students() {
        return $this->belongsTo(Students::class, 'students_id', 'id');
    }
    public function users_id() {
        return $this->belongsTo(User::class, 'students_id', 'id');
    }
}
