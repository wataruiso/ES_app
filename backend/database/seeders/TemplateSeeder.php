<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\QuestionCategory;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_categories = QuestionCategory::where('name', '!=', 'その他')->get();
        $word_counts = [200, 300, 400];
        $templates = [];
        foreach ($question_categories as $question_category) {
            foreach ($word_counts as $word_count) {
                array_push($templates, [
                    'question_category_id' => $question_category->id,
                    'word_count' => $word_count,
                ]);
            }
        }
        
        DB::table('templates')->insert($templates);
    }
}
