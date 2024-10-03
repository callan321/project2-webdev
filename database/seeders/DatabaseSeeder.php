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
        // Seed users
        $testStudent = User::factory()->create([
            'number' => '12345678',
            'role' => 's',  // 's' for student
            'password' => bcrypt('pass'),
            'name' => 'Test Student',
            'email' => 'test@example.com',
        ]);

        $testTeacher = User::factory()->create([
            'number' => '12345679',
            'role' => 't',  // 't' for teacher
            'password' => bcrypt('pass'),
            'name' => 'Test Teacher',
            'email' => 'test2@example.com',
        ]);

        $students = User::factory(10)->create();  // Seed additional students

        // Seed courses
        $courses = Course::factory(8)->create();

        // Seed enrollments for the test student
        $randomCourses = $courses->random(5);  // Test student enrolled in 5 random courses
        foreach ($randomCourses as $course) {
            Enrollment::create([
                'user_id' => $testStudent->id,
                'course_id' => $course->id,
            ]);
        }

        // Seed enrollments for other students (4 courses each)
        foreach ($students as $student) {
            $randomCourses = $courses->random(4);
            foreach ($randomCourses as $course) {
                Enrollment::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        // Assign the test teacher as the teacher for all courses
        foreach ($courses as $course) {
            $course->teachers()->attach($testTeacher->id);  // Attach the teacher to all courses
        }

        // Seed assessments (2 or 3 assessments per course)
        foreach ($courses as $course) {
            $numberOfAssessments = rand(2, 3);  // Randomly determine if a course gets 2 or 3 assessments
            Assessment::factory($numberOfAssessments)->create([
                'course_id' => $course->id,
            ]);
        }
    }
}
