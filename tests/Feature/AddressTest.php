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

    /* == Test crud == */
    /** @test */
    public function test_user_can_create_address()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        $this->assertCount(1, Student::all());

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

    /* == street name == */
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

    /* == street number == */
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
    public function test_street_number_could_contains_string()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'street_number' => '3/b' ]);

        $this->post('/addresses',$address->toArray());


        //then it should be in the database
        $this->assertCount(1, Address::all() );
    }

    /* == zip == */
    /** @test */
    public function test_zip_required()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'zip' => 1 ]);

        $this->post('/addresses',$address->toArray());


        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_zip_must_be_integer()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'zip' => Str::random(5) ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_zip_must_be_min_1000()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'zip' => 999 ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_zip_must_be_max_9999()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'zip' => 10000 ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /* == city == */
    /** @test */
    public function test_city_required()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'city' => '' ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /* == siblings num == */
    /** @test */
    public function test_siblings_num_required()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'siblings_num' => '' ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_siblings_num_must_be_integer()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'siblings_num' => Str::random(1) ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

    /** @test */
    public function test_siblings_num_max_127()
    {
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //make an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->make(['student_id' => $student->id, 'siblings_num' => 128 ]);

        $this->post('/addresses',$address->toArray());

        //then it should be in the database
        $this->assertCount(0, Address::all() );
    }

}
