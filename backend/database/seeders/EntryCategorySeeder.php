<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entry_categories')->insert([
            [
                'name' => '本選考',
            ],
            [
                'name' => '早期選考',
            ],
            [
                'name' => '短期インターン',
            ],
            [
                'name' => '長期インターン',
            ],
            [
                'name' => 'アルバイト',
            ],
            [
                'name' => 'イベント',
            ],
            [
                'name' => 'セミナー',
            ],
            [
                'name' => 'その他',
            ],
        ]);
    }
}
