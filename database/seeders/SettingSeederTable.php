<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            "company_name" => "Company Name",
            "mobile" => "017########",
            "email" => "admin@gmail.com",
        ]);
    }
}
