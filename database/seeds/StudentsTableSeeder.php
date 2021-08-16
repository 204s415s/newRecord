<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('students')->insert([
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
            ],
            ['student_name' => '米田圭宏',
             'enter' => '2021-08-01',
             'grade' => '学部三年生',
             'experience' => '有',
             'description' => '近畿大学\nプログラミング経験はjavaのみ(フレームワークはなし)\n就活の方向は曖昧、選択肢を増やすためにここに入った！',
             'sheet_id' => '19aKVXCS938L5ofWqCnkjRmWa3nRLNCWWPFrKahGKM0A',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ],
            ['student_name' => '山﨑元哉',
             'enter' => '2021-08-01',
             'grade' => '学部三年生',
             'experience' => '有',
             'description' => '工学部機械科\nプログラミングはC・Visual Basicをやったことがある\n就活はIT系に絞っている、SESに興味がある',
             'sheet_id' => '1Ms0yfuRR3epbKHbN-qHp5V2n7ew8J4QCHaadiQFOxy4',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ],
            ['student_name' => '米田晃大',
             'enter' => '2021-08-01',
             'grade' => '学部三年生',
             'experience' => '無',
             'description' => '神大法学部\nインターン行ったりしてるけど、ITに絞ってるわけではない',
             'sheet_id' => '1ahkFsfViWt0fPj7hPKGylTBnatSVtS9tZczwZ-MdeF0',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ]
        ]);
    }
}
