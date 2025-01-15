<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $rolegod=   Role::create(['name' => 'god']);
      $roleadmin=  Role::create(['name' => 'admin']);
      $roleteacher=  Role::create(['name' => 'teacher']);
      $rolestudent=  Role::create(['name' => 'student']);


Permission::create(['name' => 'god'])->assignRole(($rolegod));;
Permission::create(['name' => 'admin'])->syncRoles([$rolegod, $roleadmin]);

Permission::create(['name' => 'teacher'])->syncRoles([$rolegod, $roleadmin,$roleteacher]);
Permission::create(['name' => 'student'])->syncRoles([$rolegod, $roleadmin,$rolestudent]);


    }
}
