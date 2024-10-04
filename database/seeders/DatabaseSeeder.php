<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed teachers
        $testTeacher = User::factory()->create([
            'number' => '12345679',
            'role' => 't',  // 't' for teacher
            'password' => bcrypt('pass'),
            'name' => 'Test Teacher',
            'email' => 'testteacher@example.com',
        ]);

        $teachers = User::factory(5)->create([
            'role' => 't',
            'password' => bcrypt('pass'),
        ]);

        // Seed students
        $testStudent = User::factory()->create([
            'number' => '12345678',
            'role' => 's',  // 's' for student
            'password' => bcrypt('pass'),
            'name' => 'Test Student',
            'email' => 'test@example.com',
        ]);
        $testStudent2 = User::factory()->create([
            'number' => '12345677',
            'role' => 's',  // 's' for student
            'password' => bcrypt('pass'),
            'name' => 'Test Student 2',
            'email' => 'test2@example.com',
        ]);

        $students = User::factory(50)->create([  // Increase number of students
            'role' => 's',
            'password' => bcrypt('pass'),
        ]);

        // Seed courses
        $courses = Course::factory(10)->create();  // Create more courses

        // Enroll the test students in the same  5 random courses
        $randomCourses = $courses->random(5);
        foreach ($randomCourses as $course) {
            Enrollment::create([
                'user_id' => $testStudent->id,
                'course_id' => $course->id,
            ]);
            Enrollment::create([
                'user_id' => $testStudent2->id,
                'course_id' => $course->id,
            ]);
        }

        // Enroll all students into 4 random courses each
        foreach ($students as $student) {
            $randomCourses = $courses->random(4);
            foreach ($randomCourses as $course) {
                Enrollment::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        // Assign multiple teachers to courses (each course can have 2 teachers)
        foreach ($courses as $course) {
            $randomTeachers = $teachers->random(2);
            foreach ($randomTeachers as $teacher) {
                $course->teachers()->attach($teacher->id);
            }
            $course->teachers()->attach($testTeacher->id);  // Assign test teacher to all courses
        }

        // Seed assessments (3-5 assessments per course)
        foreach ($courses as $course) {
            $numberOfAssessments = rand(3, 5);  // More assessments per course
            $assessments = Assessment::factory($numberOfAssessments)->create([
                'course_id' => $course->id,
            ]);

            foreach ($assessments as $assessment) {
                foreach ($course->students->random(10) as $reviewer) {
                    $reviewees = $course->students->except($reviewer->id)->random(2);  // Each student reviews 2 others
                    foreach ($reviewees as $reviewee) {
                        // Create a review, passing the required IDs
                        Review::factory()->create([
                            'reviewer_id' => $reviewer->id,
                            'reviewee_id' => $reviewee->id,
                            'assessment_id' => $assessment->id,
                        ]);
                    }
                }
            }



        }
    }
}
