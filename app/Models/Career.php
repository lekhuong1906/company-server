<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory,SoftDeletes;
    protected $timestamp = true;
    protected $fillable = [
        'department_id',
        'name',
        'amount',
        'level',
        'description',
        'requirements',
        'benefits',
        'status',
        'salary_min',
        'salary_max',
        'negotiable',
        'end_date'
    ];
    protected $attribute = [
        'amount' => 'int',
        'level' => 'int',
        'status' => 'int',
        'end_date' => 'date'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
