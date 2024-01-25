<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\PermissionRegistrar;
use OwenIt\Auditing\Models\Audit;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class UserTableSeeder
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Estuardo Quintanilla',
            'email' => 'eaquinta@yahoo.com',
            'password' => bcrypt('12345678')
        ])->assignRole('master');

        // $rol = Role::create(['name' => 'Super-Admin']);
        // $user->assignRole($rol);

        // $auditValues = array_diff_key($user->getAttributes(), array_flip(['updated_at', 'created_at', 'password']));

         // Log the seeding change as an audit entry.
        // Audit::create([
        //     'auditable_type' => User::class,
        //     'auditable_id' => $user->id,
        //     'event' => 'create', // Indicates the type of event (create, update, delete, etc.).
        //     'old_values' => [], // For a create event, there are no old values.
        //     'new_values' => $auditValues, // Log the new values of the model.
        //     'url' => null, // You can set the URL if relevant.
        //     'ip_address' => 'localhost', // You can set the IP address if relevant.
        //     'user_agent' => null, // You can set the user agent if relevant.
        //     'user_id' => $user->id, // Set the user ID if you want to associate a specific user with the audit log.
        //     'user_type' => User::class
        // ]);
         //$permisos = Permission::pluck('id','id')->all();
        // $rol->syncPermissions($permisos);
        //$user->assignRole([$rol->id]);
    }
}
