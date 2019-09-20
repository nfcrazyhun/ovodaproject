<?php

namespace Tests\Feature;

use App\Address;
use App\Student;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutingTest extends TestCase
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
    public function test_guest_see_index_page()
    {
        $this->get('/')->assertSee('Ovoda');
    }

    /** @test */
    public function test_guest_cannot_see_students_and_addresses_page_and_redirect_to_login_page()
    {
        $this->get('/students')->assertStatus(302);
        $this->get('/students')->assertRedirect('/login');

        $this->get('/addresses')->assertStatus(302);
        $this->get('/addresses')->assertRedirect('/login');
    }

    /** @test  */
    public function test_guest_cannot_create_student_and_address()
    {
        $this->post('/students')->assertStatus(302);

        $this->post('/students')->assertRedirect('/login');

        $this->post('/addresses')->assertStatus(302);

        $this->post('/addresses')->assertRedirect('/login');
    }

    /** @test */
    public function test_user_can_see_students_and_addresses_page()
    {
        $this->actingAsUser();

        $this->get('/students')->assertStatus(200);

        $this->get('/addresses')->assertStatus(200);
    }

    /** @test */
    public function test_user_can_show_a_student()
    {
        $this->actingAsUser();

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        $this->get('/students/'.$student->id)->assertSee($student->first_name);
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
        /** Sometimes throws error because the street name contains " ' " quotation marks, shoot you faker->streetname !!!  */
        $this->get('/addresses/'.$address->id)->assertSee($address->street_name);
    }


    /** @test */
    public function test_guest_cannot_shown_a_student()
    {
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        $this->get('/students/'.$student->id)->assertStatus(302);
    }

    /** @test */
    public function test_guest_cannot_shown_an_address()
    {
        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create();

        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        $this->assertCount(1,Address::all());

        $this->get('/addresses/'.$address->id)->assertStatus(302);
    }

    /** @test  */
    public function test_guest_cannot_visit_address_create_page()
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

}
