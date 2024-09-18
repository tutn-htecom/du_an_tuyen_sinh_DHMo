<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'id',
        'name',
        'code',
        'email',
        'phone',
        'date_of_birth',
        'avatar',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
  
}
