<?php

use Illuminate\Database\Seeder;

// use App\Company;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        // $this->call(UsersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);

        // Company::insert([
        //     'id' => '6',
        //     'name' => Str::random(10),
        //     'description' => Str::random(20),
        //     'user_id' => '4',
        // ]);
        // Model::reguard();
    }
}
