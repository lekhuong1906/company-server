<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobLevel;

class JobLeverSeeder extends Seeder
{
    const LEVEL_LIST = [
        0 => [
            'name' => 'Intern',
            'slug' => 'intern'
        ],
        1 => [
            'name' => 'Fresher',
            'slug' => 'fresher'
        ],
        2 => [
            'name' => 'Junior',
            'slug' => 'junior'
        ],
        3 => [
            'name' => 'Middle',
            'slug' => 'middle'
        ],
        4 => [
            'name' => 'Senior',
            'slug' => 'senior'
        ],
        5 => [
            'name' => 'Leader',
            'slug' => 'leader'
        ],
        6 => [
            'name' => 'Technical Leader',
            'slug' => 'tech-lead'
        ],
        7 => [
            'name' => 'Manager',
            'slug' => 'manager'
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(self::LEVEL_LIST as $item){
            JobLevel::create($item);
        }
    }
}
