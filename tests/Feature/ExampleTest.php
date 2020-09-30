<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // =$this->get('/');
        $response=$this->get('/');
        $response->assertViewIs('welcome');
        // $response->assert Status(200);
        // $response->see('');
        // $response->assertStatus(200);

    }
}
