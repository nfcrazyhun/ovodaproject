<?php

namespace Tests\Feature;

use App\Address;
use App\Student;
use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;


    /**
     *  Mini-method for shorting create user and login with it
     */
    private function actingAsUser()
    {
        //create and login a user
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }

    /* --------------------------- TESTS --------------------------- */

    /** @test */
    public function test_user_can_create_address()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(1, Address::all() );
    }

    /** @test */
    public function test_user_can_modify_address()
    {
        //create and login a user
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //create an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        $address->street_name = 'assambliamli';

        $this->patch('/addresses/'.$address->id, $address->toArray());

        $this->assertDatabaseHas('address', ['street_name' => $address->street_name]);

        $this->assertCount(1, Student::all() );
    }

    /** @test */
    public function test_user_can_delete_address()
    {
        //create and login a user
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //create an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        $this->assertDatabaseHas('address', ['student_id' => $student->id]);

        $this->delete('/addresses/'.$address->id);

        $this->assertDatabaseMissing('address', ['id' => $address->id]);

        $this->assertCount(0, Address::all() );
    }

    /* --------------------------- VALIDATION TESTS --------------------------- */

    /** @test */
    public function test_street_name_required()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'street_name' => '']);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_street_number_required()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'street_number' => '']);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_street_number_must_be_integer()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'street_number' => Str::random(1)]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_street_number_must_be_positive()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'street_number' => '-1' ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

}
