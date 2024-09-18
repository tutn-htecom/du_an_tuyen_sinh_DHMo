<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScoreAdminssions extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'score_adminssions';
    protected $fillable = [
        'id', 'leads_id', 'form_adminssions_id', 'method_adminssions_id', 'province_name', 'school_name', 
        'marjors_id', 'score_avg', 'block_adminssions_id', 'score1', 'score2', 'score3', 
        'total_score', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'
    ];   
    public function lead() {
        return $this->belongsTo(Leads::class, 'leads_id', 'id');
    }
    public function block_adminssion() {
        return $this->belongsTo(Leads::class, 'block_adminssions_id', 'id');
    }
}
