<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function testBadRequestApiLocationByIP() 
    {
        $response = $this->get('api/locationByIP?I=191.179.98.22');

        $response->assertStatus(400);
    }

    public function testNotFoundApiLocationByIP() 
    {
        $response = $this->get('api/locationByIP?IP=127.0.0.1');

        $response->assertStatus(404);
    }

    public function testSuccessApiLocationByIP() 
    {
        $response = $this->get('api/locationByIP?IP=191.179.98.22');

        $response
            ->assertStatus(200)
            ->assertJson([
                'country_code'=>'BR',
                'country_name'=>'Brazil'
            ]);
    }

    public function testSuccessIPFromGermany() 
    {
        $response = $this->get('api/locationByIP?IP=2.16.6.0');

        $response
            ->assertStatus(200)
            ->assertJson([
                'country_code'=>'DE',
                'country_name'=>'Germany'
            ]);
    }
    
}
