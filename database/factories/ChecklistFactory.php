<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checklist>
 */
class ChecklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name_fake = fake()->name();
        $name_valid = trim($name_fake, ' ');
        
        $name_checklist = strtoupper(substr($name_valid,0,4));

        return [
            'checklist_name' => $name_checklist,
        ];
    }
}
