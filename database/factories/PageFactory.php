<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
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
                'About Us',
                'Privacy Policy',
                'Terms and Conditions',
                'Help Center',
                'Contact Us'
            ]),
            'content' => 'This is static page content used for search testing.',
        ];
    }
}
