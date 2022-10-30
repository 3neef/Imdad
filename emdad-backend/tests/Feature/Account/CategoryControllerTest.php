<?php

namespace Tests\Feature\Account;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_catogry()
    {
        $response = $this->call('post', 'api/v1_0/categroyes/SaveCatogry', [
            "name" => 'oknew2',
            "isleaf" => '1',
            "companyId" => '1',
        ]);
        //dd($response->status());
        $response->assertStatus(201);
    }

    public function test_aproved_catogry()
    {
        $response = $this->call('post', 'api/v1_0/categroyes/aprovedcatogre/2');
        $response->assertStatus(200);
    }


    public function test_show_all_aproved_catogry()
    {
        $response = $this->call('get', 'api/v1_0/categroyes/showallaprovedcatogre');
        $response->assertStatus(200);
    }




    public function test_show_all_catogry()
    {
        $response = $this->call('get', 'api/v1_0/categroyes/showallcatogre');
        $response->assertStatus(200);
    }



    public function test_create_sub_catogry()
    {
        $response = $this->call('post', 'api/v1_0/categroyes/SavesubCatogre', [
            "name" => 'oknew3',
            "isleaf" => '1',
            "companyId" => '1',
            "parent_id" => '1',
        ]);
        //dd($response->status());
        $response->assertStatus(200);
    }

    public function test_show_with_catogre()
    {
        $response = $this->call('post', 'api/v1_0/categroyes/showwithcatogreid');
        $response->assertStatus(200);
    }



    public function test_aproved_sub_catogre()
    {
        $response = $this->call('post', 'api/v1_0/categroyes/aprovedsubcatogre/5');
        $response->assertStatus(200);
    }

    public function test_get_by_companyid()
    {
        $response = $this->call('post', 'api/v1_0/categroyes/getByCompanyId/1');
        $response->assertStatus(200);
    }
}
