<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\QuestionCategory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $question_category = QuestionCategory::inRandomOrder()->first();

        return [
            'name' => $question_category->name != 'その他' ? $question_category->name : $this->faker->realText(20),
            'question_category_id' => $question_category->id,
            'word_count' => rand(1,10) * 100,
            'answer' => $this->faker->realText(300),
        ];
    }

}
