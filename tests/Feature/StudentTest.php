<?php

namespace Tests\Feature;

use App\Student;
use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    //refresh the database before every test run
    use RefreshDatabase;


    /**
     *  Mini-method for shorting create user and login with it
     */
    private function actingAsUser()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }

    /* --------------------------- TESTS --------------------------- */

    /** @test */
    public function test_user_can_create_a_student()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        //create a student instance
        $student = factory(Student::class)->make();
        //create a new student with the necessary data
        $this->post('/students',$student->toArray());
        //then it should be in the database
        $this->assertCount(1, Student::all() );

    }

    /** @test */
    public function test_user_can_modify_a_student()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        $student->first_name = 'beta';

        $this->patch('/students/'.$student->id, $student->toArray());

        $this->assertDatabaseHas('student',['first_name' => $student->first_name]);

        $this->assertCount(1, Student::all() );
    }

    /** @test */
    public function test_user_can_delete_a_student()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        $this->delete('/students/'.$student->id);

        $this->assertDatabaseMissing('student',['first_name' => $student->first_name]);

        $this->assertCount(0, Student::all() );

    }


    /* --------------------------- VALIDATION TESTS --------------------------- */

    /** @test */
    public function test_first_name_required()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->make(['first_name' => '']);

        $this->post('/students',$student->toArray());
        //then it should be in the database
        $this->assertCount(0, Student::all() );
    }

    /** @test */
    public function test_first_name_min_3_char()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->make(['first_name' => Str::random(1)]);

        $this->post('/students',$student->toArray());

        $this->assertCount(0, Student::all() );
    }

    /** @test */
    public function test_last_name_required()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->make(['last_name' => '']);

        $this->post('/students',$student->toArray());
        //then it should be in the database
        $this->assertCount(0, Student::all() );
    }

    /** @test */
    public function test_last_name_min_3_char()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->make(['last_name' => Str::random(1)]);

        $this->post('/students',$student->toArray());

        $this->assertCount(0, Student::all() );
    }

    /** @test */
    public function test_group_required()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->make(['group' => '']);

        $this->post('/students',$student->toArray());
        //then it should be in the database
        $this->assertCount(0, Student::all() );
    }

    /** @test */
    public function test_age_required()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->make(['group' => '']);

        $this->post('/students',$student->toArray());
        //then it should be in the database
        $this->assertCount(0, Student::all() );
    }

}
