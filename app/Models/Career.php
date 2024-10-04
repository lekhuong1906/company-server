<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $timestamp = true;
    protected $fillable = [
        'department_id',
        'career_name',
        'career_amount',
        'career_level',
        'career_description',
        'career_require',
        'career_status',
        'career_end_date'
    ];
    protected $attribute = [
        'career_amount' => 'int',
        'career_level' => 'int',
        'career_status' => 'int',
        'career_end_date' => 'date'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
