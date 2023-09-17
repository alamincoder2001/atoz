<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sandofvega\Bdgeocode\Seeds\BdgeocodeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeederTable::class);
        $this->call(SettingSeederTable::class);
        $this->call(BdgeocodeSeeder::class);
        $this->call(PermissionSeederTable::class);
    }
}
