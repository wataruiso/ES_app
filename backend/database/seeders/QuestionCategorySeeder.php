<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_categories')->insert([
            [
                'name' => 'ガクチカ',
            ],
            [
                'name' => '志望動機',
            ],
            [
                'name' => '就活の軸',
            ],
            [
                'name' => '長所・短所',
            ],
            [
                'name' => '入社後やりたいこと',
            ],
            [
                'name' => '困難だった経験',
            ],
        ]);
    }
}
