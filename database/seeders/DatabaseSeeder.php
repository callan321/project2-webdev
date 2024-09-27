<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // seed users
        $testUser = User::factory()->create([
            'number' => '12345678',
            'role' => 's',
            'password' => 'pass',
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $students = User::factory(10)->create();


        // seed courses
        $courses = Course::factory(8)->create();


        // seed enrollments
        // test user only
        $randomCourses = $courses->random(5);
        foreach ($randomCourses as $course) {
            Enrollment::create([
                'user_id' => $testUser->id,
                'course_id' => $course->id,
            ]);
        }
        // all other courses
        foreach ($students as $student) {
            $randomCourses = $courses->random(4);
            foreach ($randomCourses as $course) {
                Enrollment::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        // seed assessments (2 or 3 assessments per course)
        foreach ($courses as $course) {
            // Randomly determine if a course gets 2 or 3 assessments
            $numberOfAssessments = rand(2, 3);

            // Create assessments for the course
            Assessment::factory($numberOfAssessments)->create([
                'course_id' => $course->id,
            ]);
        }
    }
}
