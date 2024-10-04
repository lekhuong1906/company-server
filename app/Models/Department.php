<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $timestamp = true;
    protected $fillable = [
        'department_name',
        'slug'
    ];


    public function careers()
    {
        return $this->hasMany(Career::class, 'department_id', 'id');
    }
}
