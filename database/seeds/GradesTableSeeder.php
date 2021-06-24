<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            ['value' => '学部1年生',],
            ['value' => '学部2年生',],
            ['value' => '学部3年生',],
            ['value' => '学部4年生',],
            ['value' => '修士1年生',],
            ['value' => '修士2年生',],
            ['value' => '博士1年生',],
            ['value' => '博士2年生',],
            ['value' => '博士3年生',],
            ['value' => '専門1年生',],
            ['value' => '専門2年生',]
        ]);
    }
}
