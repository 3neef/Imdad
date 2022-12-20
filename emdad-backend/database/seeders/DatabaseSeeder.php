<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Emdad\RelatedCompanies;
use Database\Factories\RelatedFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      SubscriptionPackagesSeeder::class,
      RegRoleSeeder::class,
      CategoriesSeeder::class,
      RelatedCompinesTableSeeder::class,
      UOMSeeder::class,
      PermissionSeeder::class,
    ]);
  }
}
