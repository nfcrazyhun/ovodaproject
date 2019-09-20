<?php

namespace Tests\Feature;

use App\Address;
use App\Student;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function test_user_can_create_address()
    {
        //create and login a user
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //create an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        //check if database has record with the student's id
        $this->assertDatabaseHas('address', ['student_id' => $student->id]);
    }

    /** @test */
    public function test_user_can_show_address()
    {
        //create and login a user
        $this->actingAsUser();

        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //create an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        //returns the correct view
        $this->get('/addresses/'.$address->id)->assertViewIs('addresses.show');

        //page found with the given id
        $this->get('/addresses/'.$address->id)->assertStatus(200);

        //controller passed 'address' variable with compact();
        $this->get('/addresses/'.$address->id)->assertViewHas('address');

        //and you can see the street name too
        $this->get('/addresses/'.$address->id)->assertSee($address->street_name);
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
    }

    /** @test  */
    public function test_guest_cannot_create_an_address()
    {
        //guest got redirected
        $this->get('/addresses/create')->assertStatus(302);
    }

    /** @test  */
    public function test_guest_cannot_show_an_address()
    {
        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //create an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        //guest got redirected
        $this->get('/addresses/'.$address->id)->assertStatus(302);
    }

    /** @test  */
    public function test_guest_cannot_modify_an_address()
    {
        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //create an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        $address->street_name = 'dinaladinn';

        //try to modify but cot redirected
        $this->patch('/addresses/'.$address->id, $address->toArray())->assertStatus(302);
    }

    /** @test  */
    public function test_quest_cannot_delete_address()
    {
        //create a student
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        //create an address with the student's id
        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        $this->assertDatabaseHas('address', ['student_id' => $student->id]);

        //guest got redirected
        $this->delete('/addresses/'.$address->id)->assertRedirect();

        //check if is no deletion happened
        $this->assertDatabaseHas('address', ['id' => $address->id]);
    }

    /**
     *  Mini-method for shorting create user and login with it
     */
    private function actingAsUser()
    {
        //create and login a user
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }

}
