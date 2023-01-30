<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superuserRole = Role::create([
            'name' => 'superuser',
            'guard_name' => 'web',
        ]);

        $crud = function (string $key) {
            return [
                'create' => Permission::create([
                    'name' => "create {$key}",
                    'guard_name' => 'web',
                ]),

                'read' => Permission::create([
                    'name' => "read {$key}",
                    'guard_name' => 'web',
                ]),

                'update' => Permission::create([
                    'name' => "update {$key}",
                    'guard_name' => 'web',
                ]),

                'delete' => Permission::create([
                    'name' => "delete {$key}",
                    'guard_name' => 'web',
                ]),
            ];
        };

        $permissions = [
            'users' => $crud('user'),
            'roles' => $crud('role'),
            'permissions' => $crud('permission'),
            'menus' => $crud('menu'),
        ];

        $superuser = User::create([
            'name' => 'Super User',
            'email' => 'superuser@example.com',
            'username' => 'superuser',
            'password' => Hash::make('password'),
            'profile_photo' => "https://ui-avatars.com/api/?name=Super+User",
        ]);

        $superuser->assignRole($superuserRole);
    }
}
