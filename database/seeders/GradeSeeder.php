<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('grades')->delete();
        
        \DB::table('grades')->insert(array (
            0 => 
            array (
                'id' => 1,
                'grade_code' => 'G1',
                'min_score' => '80',
                'max_score' => '100',
                'letter_grade' => 'A1',
                'comment_grade' => 'Excellent',
                'gpa_grade' => '7',
                'registration_code' => '100-200',
                'grade_scale_type' => 'GS7',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}