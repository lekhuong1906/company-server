<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory,SoftDeletes;
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'slug'
    ];


    public function careers()
    {
        return $this->hasMany(Career::class, 'department_id', 'id');
    }
}
