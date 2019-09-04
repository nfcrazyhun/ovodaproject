<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //define an empty array
        $students = array();

        //append to array
        $students[] = factory(App\Student::class)->create([
            'first_name' => 'Péter',
            'last_name' => 'Horváth',
        ]);

        //append to array again
        $students[] = factory(App\Student::class)->create([
            'first_name' => 'Júlia',
            'last_name' => 'Kovács',
        ]);

        //create students with address via they factories
        foreach ($students as $item) {
            factory(\App\Address::class)->create([
                'student_id' => $item->id,
            ]);
        }





//        DB::table('student')->insert([
//            'first_name' => 'Péter',
//            'last_name' => 'Horváth',
//            'sign'=>'placeholder.png',
//            'group'=> 1,
//            'age'=> 5,
//        ]);
//
//        DB::table('student')->insert([
//            'first_name' => 'Júlia',
//            'last_name' => 'Kovács',
//            'sign'=>'placeholder.png',
//            'group'=> 1,
//            'age'=> 6,
//        ]);


    }
}
