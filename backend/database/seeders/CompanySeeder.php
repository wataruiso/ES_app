<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => '伊藤忠テクノ',
            ],
            [
                'name' => 'NTTデータ',
            ],
            [
                'name' => 'SCSK',
            ],
            [
                'name' => 'アクセンチュア',
            ],
            [
                'name' => 'Salesforce',
            ],
            [
                'name' => 'タタコンサル',
            ],
            [
                'name' => 'TIS',
            ],
            [
                'name' => '中央大学法人',
            ],
            [
                'name' => '日本ユニシス',
            ],
        ]);
    }
}
