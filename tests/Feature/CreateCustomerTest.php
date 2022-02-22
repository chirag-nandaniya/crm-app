<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_page_have_create_text()
    {
        $response = $this->get('/customers/create');

        $response->assertSeeText('Create');
    }

    public function test_see_customer_was_created_in_database()
    {
        //Arrange
        $customer = new Customer();
        $customer->name = 'Chirag Nandaniya';
        $customer->phone_number = '9727587943';
        $customer->email =  'chirag@hetarthconsulting.com';
        $customer->budget = 45454;
        $customer->message = 'Test Message From Chirag';
        $customer->save();

        //Act
        $response = $this->get('/');

        //Assert
        $this->assertDatabaseHas('customers', [
            'name' => 'Chirag Nandaniya'
        ]);

    }
}