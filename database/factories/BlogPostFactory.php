<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'Laravel Basics',
                'Getting Started with PHP',
                'Understanding MVC Architecture',
                'Introduction to Web Development',
                'What is REST API?'
            ]),
            'body' => 'This is a blog post used for testing the search system.',
            'tags' => 'laravel,php,webdev',
            'published_at' => now(),
        ];
    }
}
