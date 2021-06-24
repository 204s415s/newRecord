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
            ['student_name' => 'てすと',
             'class' => '1',
             'grade' => '学部三年生',
             'experience' => '無',
             'description' => '日曜日がいい',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ],
            ['student_name' => 'てすとつー',
             'class' => '2',
             'grade' => '修士一年生',
             'experience' => '有',
             'description' => '来校難しい',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ],
            ['student_name' => 'てすとすりー',
             'class' => '3',
             'grade' => '学部四年生',
             'experience' => '有',
             'description' => '就活終わってる',
             'user_id' => '1',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
            ]
        ]);
    }
}
