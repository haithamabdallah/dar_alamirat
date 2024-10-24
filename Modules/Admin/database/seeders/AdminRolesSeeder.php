<?php

namespace Modules\Admin\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\app\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Admin::updateOrCreate([
            // 'id'        => 1,
            'userName'  => 'admin',
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'phone'     => '0123456789',
            'password'  => '123456789',
            'system'    => 1,
        ]);

        $admin2 = Admin::updateOrCreate([
            // 'id'        => 2,
            'userName'  => 'ali',
            'name'      => 'Ali',
            'email'     => 'alisultan@daaralamirat.com',
            'phone'     => '0123456789',
            'password'  => '123456789',
            'system'    => 1,
        ]);

        $admin3 = Admin::updateOrCreate([
            // 'id'        => 3,
            'userName'  => 'hiba',
            'name'      => 'Hiba',
            'email'     => 'hibasultan@daaralamirat.com',
            'phone'     => '0123456789',
            'password'  => '123456789',
            'system'    => 1,
        ]);

        $admin4 = Admin::updateOrCreate([
            // 'id'        => 4,
            'userName'  => 'sofyan ',
            'name'      => 'Sofyan',
            'email'     => 'sofyansultan@daaralamirat.com',
            'phone'     => '0123456789',
            'password'  => '123456789',
            'system'    => 1,
        ]);

        $admin5 = Admin::updateOrCreate([
            // 'id'        => 5,
            'userName'  => 'hana',
            'name'      => 'Hana',
            'email'     => 'hanasultan@daaralamirat.com',
            'phone'     => '0123456789',
            'password'  => '123456789',
            'system'    => 1,
        ]);

        $admin6 = Admin::updateOrCreate([
            // 'id'        => 6,
            'userName'  => 'super',
            'name'      => 'Super',
            'email'     => 'super@daaralamirat.com',
            'phone'     => '+201234567891',
            'password'  => '123456789',
            'system'    => 1,
            'role_id'   => 2,
        ]);
        
        /* Modules\Admin\app\Models\ */
        Admin::where('userName', 'admin')->update(['password' => bcrypt('Cvbw-Awer-Jkil-2843')]);
        Admin::where('userName', 'ali')->update(['password' => bcrypt('Zxc-Asd-Qwe-123')]);
        Admin::where('userName', 'hiba')->update(['password' => bcrypt('Vbn-Ghj-Yui-678')]);
        Admin::where('userName', 'hana')->update(['password' => bcrypt('Ftg-Cgv-Jik-891')]);
        // Admin::where('userName', 'sofyan')->update(['password' => bcrypt('Mlp-Nko-Bji-764')]);
        // Admin::where('userName' , 'sofyan')->update(['password' => bcrypt('Mla-Nao-Bqi-789')]);
        
        $admin = \Modules\Admin\app\Models\Admin::where('userName' , 'sofyan')->first();
        $admin->delete();
        $admin4 = Admin::updateOrCreate([
            // 'id'        => 4,
            'userName'  => 'sofyan ',
            'name'      => 'Sofyan',
            'email'     => 'sofyansultan@daaralamirat.com',
            'phone'     => '0123456789',
            'password'  => '123456789',
            'system'    => 1,
        ]);

        \Modules\Admin\app\Models\Admin::where('userName' , 'sofyan')->update(['password' => bcrypt('Gfb-Nrt-Bqe-562') , 'remember_token' => null ]); // updated 05/10/2024

        Admin::where('userName' , 'super')->update(['password' => bcrypt('Afg-Fdr-Qrt-582')]);
    }
}
