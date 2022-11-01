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
            "name"=>'ahmed',
            "password"=>"ahmed",
            "email"=>"ahmed@gmail.com",
            "mobile"=>"012909892783",
            "roleId"=> "1",
            "companyId"=> "1"
        ]);
        $response->assertStatus(200);
    }

    public function testcreateUserToCompany(){

    }
    public function testloginUser(){

    }
    public function testactivateUser(){

    }
    public function testlogoutUser(){

    }
    public function testupdateUser(){

    }
    public function testdeleteUser(){

    }
    public function testrestoreUser(){
    }
    public function testforgotPassword(){
        //
    }
    public function testresetPassword(){
        //
    }
    public function testassignRole(){
        //
    }
    public function testunAssignRole(){
        //
    }
    public function testrestoreOldRole(){
        //
    }
    public function testsetDefaultCompany(){
        //
    }
}
