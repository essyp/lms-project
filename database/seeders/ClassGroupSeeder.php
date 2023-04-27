<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('class_groups')->delete();
        
        \DB::table('class_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'JSS1-DIA',
                'name' => 'Diamond JS1',
                'next_class' => 'JSS2-DIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'JSS2-DIA',
                'name' => 'Diamond JS2',
                'next_class' => 'JSS3-DIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'JSS3-DIA',
                'name' => 'Diamond JS3',
                'next_class' => 'SS1-DIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'SS1-DIA',
                'name' => 'Diamond SS1',
                'next_class' => 'SS2-DIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'SS2-DIA',
                'name' => 'Diamond SS2',
                'next_class' => 'SS3-DIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'SS3-DIA',
                'name' => 'Diamond SS3',
                'next_class' => 'Graduate',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'Primary',
                'name' => 'Primary Diamond',
                'next_class' => 'JSS1-DIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            
            7 => 
            array (
                'id' => 8,
                'code' => 'JSS1-GLD',
                'name' => 'Gold JS1',
                'next_class' => 'JSS2-GLD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'JSS2-GLD',
                'name' => 'Gold JS2',
                'next_class' => 'JSS3-GLD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'JSS3-GLD',
                'name' => 'Gold JS3',
                'next_class' => 'SS1-GLD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'SS1-GLD',
                'name' => 'Gold SS1',
                'next_class' => 'SS2-GLD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'SS2-GLD',
                'name' => 'Gold SS2',
                'next_class' => 'SS3-GLD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'SS3-GLD',
                'name' => 'Gold SS3',
                'next_class' => 'Graduate',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'Primary2',
                'name' => 'Primary Gold',
                'next_class' => 'JSS1-GLD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}