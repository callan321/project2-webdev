<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // departs and subjects
        $subjects = [
            'MTH' => [
                'Calculus I',
                'Linear Algebra',
                'Discrete Mathematics',
                'Probability and Statistics',
                'Numerical Methods',
            ],
            'ICT' => [
                'Introduction to Programming',
                'Data Structures',
                'Algorithms',
                'Database Systems',
                'Operating Systems',
                'Software Engineering',
                'Computer Networks',
                'Web Development',
                'Mobile Application Development',
                'Cybersecurity',
                'Artificial Intelligence',
                'Machine Learning',
                'Cloud Computing',
                'Big Data Analytics',
                'Human-Computer Interaction',
                'Internet of Things (IoT)',
                'Data Science',
                'Information Systems Management',
                'Network Security',
                'Embedded Systems',
                'System Architecture',
                'Digital Signal Processing',
                'Quantum Computing',
            ],
            'ENG' => [
                'Technical Writing',
                'English Composition',
                'Public Speaking',
            ],
            'HUM' => [
                'Psychology of Technology',
                'Philosophy of Artificial Intelligence',
                'History of Computing',
            ],
            'SCI' => [
                'Digital Signal Processing',
                'Big Data Analytics',
                'Cloud Computing',
                'Quantum Computing',
            ],
            'ART' => [
                'Digital Media Design',
                'Game Development',
                'Graphics Programming',
            ],
            'BUS' => [
                'Business Intelligence',
                'Ethics in Information Technology',
                'Project Management',
                'Innovation and Entrepreneurship',
            ],
        ];

        // select rand department then a rand subject from that department
        $department = fake()->randomElement(array_keys($subjects));
        $subjectName = fake()->randomElement($subjects[$department]);

        // Generate courses similar to griffith
        $courseCode = $department
            . fake()->randomElement(['10', '20', '30', '50'])
            . fake()->numerify('###');

        return [
            'code' => $courseCode,
            'name' => $subjectName,
        ];

    }
}
