<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    const DEPARTMENT = [
        0 => [
            'name' => 'Unity',
            'slug' => 'unity'
        ],
        1 => [
            'name' => 'Web',
            'slug' => 'web'
        ],
        2 => [
            'name' => 'Design',
            'slug' => 'design'
        ],
        3 => [
            'name' => 'Hr',
            'slug' => 'hr'
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(self::DEPARTMENT as $item){
            Department::create($item);
        }
    }
}
