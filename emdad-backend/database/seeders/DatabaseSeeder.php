<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accounts\SubscriptionPackages;
use App\Models\Emdad\Categories;
use App\Models\Emdad\RelatedCompanies;
use App\Models\Emdad\Unit_of_measures;
use App\Models\UM\Permission;
use App\Models\UM\Role;
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

        if (SubscriptionPackages::count() > 0 || Role::count() > 0 || Categories::count() > 0 || Unit_of_measures::count() > 0 || Permission::count() > 0) {
            DB::table('roles')->delete();
            DB::table('permissions')->delete();
            DB::table('unit_of_measures')->delete();
            DB::table('categories')->delete();
            DB::table('subscription_packages')->delete();
        }

        $this->call([
            ApiKeysSeeder::class,
            SubscriptionPackagesSeeder::class,
            PermissionSeeder::class,

            RegRoleSeeder::class,
            CategoriesSeeder::class,
            UOMSeeder::class,
            RelatedCompinesTableSeeder::class,
        ]);
    }
}
