<?php

use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsDnameSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Konekt\Address\Seeds\Countries::class);
        $this->call(PermissionsDnameSeeder::class);

    }
}
