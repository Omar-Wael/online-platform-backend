<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure you are assigning an instructor user to the course
        Course::factory()->count(10)->create([
            'user_id' => User::instructor()->first()->id,  // Use the instructor scope
        ]);
    }
}
