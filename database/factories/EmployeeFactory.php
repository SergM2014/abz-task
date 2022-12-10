<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstNameMale(),
            'last_name' => fake()->lastName(),
            'position_id' => 1,
            'leader_id' => 0,
            'employment_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'phone' => fake()->unique()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'salary' => fake()->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 500.000),
            'photo' => 'no-avatar.png',
            'created_at' => fake()->dateTimeBetween('-10 day'),
            'updated_at' => fake()->dateTimeBetween('-5 day'),
        ];
    }

    public function viceDirector()
    {
        return $this->state( function() {
            return [
                'position_id' => 2,
                'leader_id' => 1
            ] ;
        });
    }

    public function teamLeader()
    {
        $superiors = Employee::where('position_id', 2)->pluck('id')->toArray();

        return $this->state( fn()  => [
                'position_id' => 3,
                'leader_id' => fake()->randomElement($superiors),
            ] );
        
    }

    public function supervisor()
    {
        $superiors = Employee::where('position_id', 3)->pluck('id')->toArray();

        return $this->state( fn()  => [
                'position_id' => 4,
                'leader_id' => fake()->randomElement($superiors),
            ] );
        
    }
    public function Employee()
    {
        $superiors = Employee::where('position_id', 4)->pluck('id')->toArray();

        return $this->state( fn()  => [
                'position_id' => 5,
                'leader_id' => fake()->randomElement($superiors),
            ] );
        
    }
}
