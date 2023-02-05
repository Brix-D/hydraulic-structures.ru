<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $permissions = [
                'register-worker',
                'edit-permission',
                'view-measure',
                'store-measure',
                'edit-measure',
                'view-reports'
            ];

            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }, 3);
    }
}
