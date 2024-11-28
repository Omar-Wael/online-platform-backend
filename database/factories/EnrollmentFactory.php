<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Enrollment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['role' => 'student'])->id,
            'course_id' => Course::factory(),
            'progress' => $this->faker->numberBetween(0, 100),
        ];
    }
}
