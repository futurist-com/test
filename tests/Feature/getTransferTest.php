<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class getTransferTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/transfer');

        $response->assertStatus(200);
       // $this->assertTrue(true);
       $this->visit('/transfer')
         ->see('LAgin')
         ->dontSee('Rsails');
        $this->visit('/')
       ->click('Login')
       ->seePageIs('/login');
    }
}
