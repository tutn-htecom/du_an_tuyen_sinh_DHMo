<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Bang lưu tên của tổ hợp môn
class BlockAdminssions extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'block_adminssions';
    protected $fillable = [
        'id','name','code','subject','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];   

    public function score() {
        return $this->hasMany(ScoreAdminssions::class, 'block_adminssions_id', 'id');
    } 
}
