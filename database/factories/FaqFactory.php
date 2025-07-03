<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->randomElement([
                'What is Laravel?',
                'How do I reset my password?',
                'Where can I contact support?',
                'What payment methods are accepted?',
                'How to install this application?'
            ]),
            'answer' => 'This is a short answer for testing FAQ search.',
        ];
    }
}
