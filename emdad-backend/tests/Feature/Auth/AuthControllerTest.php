<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCeateUser()
    {
        $response = $this->call('post','api/v1_0/users/register',[
            "name"=>'dsffds',
        ]);
        $response->assertStatus(200);
    }
}
