<?php

namespace Tests\Feature;

use App\Address;
use App\Student;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    //refresh the database before every test run
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */


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
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get('/students')->assertStatus(200);

        $this->get('/addresses')->assertStatus(200);
    }

    /** @test */
    public function test_user_can_create_a_student()
    {
        //create a new user
        $user = factory(User::class)->create();
        //login with it
        $this->actingAs($user);
        /** @var \App\Student $student | typehinting */
        //create a student instance
        $student = factory(Student::class)->create(['first_name' => 'acme']);
        //create a new student with the necessary data
        $this->post('/students',$student->toArray());
        //then it should be in the database
        $this->assertDatabaseHas('student',['first_name' => $student->first_name]);

    }

    /** @test */
    public function test_user_can_create_student_with_address()
    {

        $user = factory(User::class)->create();

        $this->actingAs($user);

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create(['first_name' => 'acme']);

        $this->post('/students',$student->toArray());

        $this->assertDatabaseHas('student',['first_name' => $student->first_name]);

        /** @var \App\Address $address | typehinting */
        $address = factory(Address::class)->create(['student_id' => $student->id]);

        $this->post('/addresses',$address->toArray());

        $this->assertDatabaseHas('address',['student_id' => $student->id]);

    }

    /** @test */
    public function test_user_can_modify_a_student(){
        $user = factory(User::class)->create();

        $this->actingAs($user);

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create(['first_name' => 'acme']);

        $student->first_name = 'beta';

        $this->patch('/students/'.$student->id, $student->toArray());

        $this->assertDatabaseHas('student',['first_name' => 'beta']);
    }

    /** @test */
    public function test_user_can_delete_a_student(){
        $user = factory(User::class)->create();

        $this->actingAs($user);

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create(['first_name' => 'delta']);

        $this->delete('/students/'.$student->id);

        $this->assertDatabaseMissing('student',['first_name' => 'delta']);

    }

    /** @test */
    public function test_user_can_show_a_student()
    {
        //create and login a user
        $user = factory(User::class)->create();
        $this->actingAs($user);

        /** @var \App\Student $student | typehinting */
        $student = factory(Student::class)->create(['first_name' => 'quadrofolioli']);

        $this->get('/students/'.$student->id)->assertSee('quadrofolioli');
    }


}
