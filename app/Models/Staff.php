<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Staff extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = ['name', 'level'];

    // Model Employee.php
    public function children()
    {
        return $this->hasMany(Staff::class, 'parent_id')->with('children');
    }
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
