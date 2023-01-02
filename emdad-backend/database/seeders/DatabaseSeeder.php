<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accounts\SubscriptionPackages;
use App\Models\Emdad\Categories;
use App\Models\Emdad\RelatedCompanies;
use App\Models\Emdad\Unit_of_measures;
use App\Models\UM\Permission;
use App\Models\UM\Role;
use Ejarnutowski\LaravelApiKey\Models\ApiKey;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       
        if(ApiKey::count()==0){
            $this->call([
                ApiKeysSeeder::class]);
        }

        if(SubscriptionPackages::count()==0){
            $this->call([
                SubscriptionPackagesSeeder::class]);
        }

        if(Permission::count()==0){
            $this->call([
                PermissionSeeder::class]);
        }
        if(Unit_of_measures::count()==0){
            $this->call([
                UOMSeeder::class]);
        }

        if(Role::count()==0){

            $this->call([
                RegRoleSeeder::class]);
        }
        if(Categories::count()==0){
            $this->call([
                CategoriesSeeder::class]);
        }
        if(RelatedCompanies::count()==0){
            $this->call([
                RelatedCompinesTableSeeder::class]);
        }
       
    }
}
