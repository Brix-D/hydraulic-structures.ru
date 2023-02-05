<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::transaction(function () {
            $registerWorker = Permission::findByName('register-worker');
            $editPermission = Permission::findByName('edit-permission');
            $viewMeasure = Permission::findByName('view-measure');
            $storeMeasure = Permission::findByName('store-measure');
            $editMeasure = Permission::findByName('edit-measure');
            $viewReports = Permission::findByName('view-reports');

            $admin = new Role();
            $admin->name = 'admin';
            $admin->save();
            $admin->givePermissionTo($registerWorker, $editPermission, $editMeasure);

            $inspector = new Role();
            $inspector->name = 'inspector';
            $inspector->save();
            $inspector->givePermissionTo($viewMeasure, $storeMeasure);

            $engineer = new Role();
            $engineer->name = 'engineering-worker';
            $engineer->save();
            $engineer->givePermissionTo($viewMeasure, $viewReports);
        }, 3);

    }
}
