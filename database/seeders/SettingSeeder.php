<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'type' => 'company_phone',
            'value'  => '+966123456789'
        ]);

        Setting::create([
            'type' => 'company_name',
            'value'  => 'Dar-Alamirate'
        ]);

        Setting::create([
            'type' => 'company_web_logo',
            'value'  => 'admin-panel/assets/img/logo.png'
        ]);

        Setting::create([
            'type' => 'company_mobile_logo',
            'value'  => 'admin-panel/assets/img/logo.png'
        ]);

        Setting::create([
            'type' => 'company_email',
            'value'  => 'info@dar-alamirat.com'
        ]);

        Setting::create([
            'type' => 'company_footer_logo',
            'value'  => 'admin-panel/assets/img/logo.png'
        ]);

        Setting::create([
            'type' => 'company_copyright_text',
            'value'  => 'Designed & developed by Mohamed Eid 2024 © All rights reserved-Dar-Alamirate'
        ]);

        Setting::create([
            'type' => 'company_fav_icon',
            'value'  => 'admin-panel/assets/img/logo.png'
        ]);

        Setting::create([
            'type' => 'maintenance_mode',
            'value'  => 0
        ]);

    }
}
