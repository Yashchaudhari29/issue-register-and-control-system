<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::where('name','admin')->first();
        if(!$user){
          $user = new User;
          $user->name	= 'admin';
          $user->email = 'admin@gmail.com';
          $user->password = bcrypt('123');
          $user->save();

          $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'User Administrator', // optional
            'description' => 'User is allowed to manage and edit other users', // optional
          ]);

          $normaluser = Role::create([
            'name' => 'user',
            'display_name' => 'simple user', // optional
            'description' => 'simple user', // optional
          ]);

          $normaluser = Permission::create([
            'name' => 'simple-userpermisssion',
            'display_name' => 'simple-userpermisssion', // optional
            'description' => 'ssimple-userpermisssion', // optional
          ]);

          $userper = Permission::create([
              'name' => 'user-permission',
              'display_name' => 'crud Users', // optional
              'description' => 'crud Users', // optional
          ]);

          $role = Permission::create([
            'name' => 'role-permission',
            'display_name' => 'crud Role', // optional
            'description' => 'crud Role', // optional
          ]);

          $permission = Permission::create([
            'name' => 'permission',
            'display_name' => 'crud Permission', // optional
            'description' => 'crud Permission', // optional
          ]);

          $admin->syncPermissions([$userper->id, $role->id,$permission->id]);
          $user->syncRoles([$admin->id]);
          
        }
    }
}
