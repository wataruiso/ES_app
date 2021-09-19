<?php

namespace Database\Factories;

use App\Models\Entry;
use Illuminate\Database\Eloquent\Factories\Factory;

use \App\Models\EntryCategory;
use \App\Models\Company;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = EntryCategory::inRandomOrder()->first();

        return [
            'company_id' => Company::inRandomOrder()->first()->id,
            'entry_category_id' => $category->id,
            'category_name' => $category->name != 'その他' ? $category->name : $this->faker->realText(20),
            'deadline' => $this->faker->dateTime(),
        ];
    }
}
