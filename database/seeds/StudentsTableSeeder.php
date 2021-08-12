<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        DB::table('students')->insert([
['student_name' => '佐藤太郎',
'enter' => '2021-04-01',
'grade' => '学部三年生',
'experience' => '無',
'description' => '日曜日がいい',
'sheet_id' => '1sZPY1cN5ocNh2udfhDOpmjdyij6wao-e7-DKe5FdCQM',
'user_id' => '1',
'created_at' => new DateTime(),
'updated_at' => new DateTime(),
],
            ['student_name' => '山田花子',
             'enter' => '2021-04-01',
             'grade' => '修士一年生',
             'experience' => '有',
             'description' => '来校難しい',
             'sheet_id' => '1-b6w2P6N4VwLPKjMQYbeknCYn_d8DvqhrVdH-iibX88',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ],
            ['student_name' => '田中太郎',
             'enter' => '2021-05-01',
             'grade' => '学部四年生',
             'experience' => '有',
             'description' => '就活終わってる',
             'sheet_id' => '1spjwf-MEa8yNnsLcUveCj96f1Q9vnSUjMoGe26h8T9w',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ]
        ]);
    }
}
