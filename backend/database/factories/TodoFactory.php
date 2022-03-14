<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Entry;
use App\Models\User;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->realText(20),
            'description' => $this->faker->realText(300),
            'entry_id' => $this->createRelatedEntryId(),
            'start_at' => now(),
            'end_at' => now(),
            'is_done' => $this->faker->boolean(),
            
        ];
    }

    public function createRelatedEntryId()
    {
        $entry_id = Entry::inRandomOrder()->first()->id;
        return rand(1,100) > 80 ? $entry_id : null;
    }
}
