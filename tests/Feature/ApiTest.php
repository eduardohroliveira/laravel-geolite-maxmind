<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * Test GET request with BAD REQUEST response code
     * Instead of send 'IP' parameter, just send anything else
     * Example: 'I'
     *
     * @return void
     */
    public function testBadRequestApiLocationByIP() 
    {
        $response = $this->get('api/locationByIP?I=191.179.98.22');

        $response->assertStatus(400);
    }

    /**
     * Test GET request with NOT FOUND response code
     * Instead of send a valid 'IP' parameter, just send a invalid one.
     * Example: '127.0.0.1'
     *
     * @return void
     */
    public function testNotFoundApiLocationByIP() 
    {
        $response = $this->get('api/locationByIP?IP=127.0.0.1');

        $response->assertStatus(404);
    }

    /**
     * Test GET request with SUCCESS response code
     * Send a valid 'IP' parameter.
     * Example: '191.179.98.22'
     *
     * @return void
     */
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

    /**
     * Test GET request with SUCCESS response code
     * to confirm an IP address in Germany
     * Example: '2.16.6.0'
     *
     * @return void
     */
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
