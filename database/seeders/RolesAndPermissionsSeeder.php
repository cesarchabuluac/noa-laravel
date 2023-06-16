<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Create role admin
        $roleAdministrator = Role::updateOrCreate(['name' => 'Administrador'], ['guard_name' => 'web']);
        $roleUsers = Role::updateOrCreate(['name' => 'Usuario'], ['guard_name' => 'web']);

        Permission::updateOrCreate(['name' => 'users.index'], ['guard_name' => 'web']);   
        Permission::updateOrCreate(['name' => 'users.create'], ['guard_name' => 'web']);
        Permission::updateOrCreate(['name' => 'users.edit'], ['guard_name' => 'web']);
        Permission::updateOrCreate(['name' => 'users.destroy'], ['guard_name' => 'web']);
        Permission::updateOrCreate(['name' => 'users.restore'], ['guard_name' => 'web']);

        $roleAdministrator->givePermissionTo(Permission::all());
        $roleUsers->givePermissionTo(['users.index']);

        $user = User::find(1);
        if (empty($user)) {
            $user = User::create([
                'name' => "Administrador",
                'email' => "admin@demo.com",
                'email_verified_at' => now(),
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(10),
            ]);
            $user->assignRole('Administrador');
        } else {
            if (!$user->hasRole('Administrador')) {
                $user->assignRole('Administrador');
            }
        }     
    }
}
