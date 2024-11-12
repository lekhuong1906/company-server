<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;
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

    public function jobLevel()
    {
        return $this->belongsTo(JobLevel::class, 'level', 'id');
    }

    public function scopeGetList($query, $amount = 1000)
    {
        return $query->select('id', 'name', 'department_id', 'amount', 'status', 'level')
            ->with(['department:id,name', 'jobLevel:id,name']) // Eager load để lấy name từ bảng department và level
            ->orderBy('id', 'desc')
            ->take($amount)
            ->get()
            ->map(function ($job) {
                return [
                    'id' => $job->id,
                    'name' => $job->name,
                    'amount' => $job->amount,
                    'status' => $job->status,
                    'department_name' => $job->department->name, // Lấy tên từ department
                    'level_name' => $job->jobLevel->name, // Lấy tên từ level
                ];
            });
    }
}
