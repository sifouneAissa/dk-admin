<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public $admins = [
        'admin@demo.com'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permissions = config('per.all');

        foreach ($permissions as $per) {
            if (!$mper = Permission::query()->where('name', $per)->exists()) {

                Permission::query()->create([
                    'name' => $per,
                    'guard_name' => 'web'
                ]);
            }
        }

        $roles = config('per.roles');

        foreach ($roles as $role) {
            $mrole = Role::query()->where('name', $role)->first();
            $permissions = $role['permissions'];


            if (!$mrole) {
                $mrole = Role::query()->create([
                    'name' => $role['name'],
                    'guard_name' => $role['guard_name']
                ]);
            } else {
                $mrole->update([
                    'name' => $role['name'],
                    'guard_name' => $role['guard_name']
                ]);
            }

            // for permissions
            if ($permissions === 'all') {
                foreach (Permission::all() as $permission){
                    if(!$mrole->hasPermissionTo($permission->name)){
                        $mrole->givePermissionTo($permission);
                    }
                }
            } else {
                foreach ($permissions as $permission){
                    $permission = Permission::query()->where('name' , $permission['name'])->first();
                    if(!$mrole->hasPermissionTo($permission->name)){
                        $mrole->givePermissionTo($permission);
                    }
                }
            }

            $users = $role['users'];

            foreach ($users as $user) {
                $muser = User::query()->where('email', $user['email'])->first();

                if (!$muser) {
                    $muser = User::query()->create([
                        'email' => $user['email'],
                        'password' => Hash::make($user['password']),
                        'name' => $user['name'],
                        'is_admin' => true
                    ]);
                } else {
                    $muser->update([
                        'email' => $user['email'],
                        'password' => Hash::make($user['password']),
                        'name' => $user['name'],
                        'is_admin' => true
                    ]);
                }

                if (!$muser->hasRole($mrole->name)) {
                    $muser->assignRole($mrole);
                }
            }
        }

    }
}
