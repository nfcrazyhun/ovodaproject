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
        DB::table('student')->insert([
            'first_name' => 'Péter',
            'last_name' => 'Horváth',
            'sign'=>'placeholder.png',
            'group'=>function () {return factory(App\Student::class)->create()->group;},
            'age'=>function () {return factory(App\Student::class)->create()->age;},
        ]);
    }
}
