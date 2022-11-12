<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::query()->forceDelete();
        $user =   \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        \App\Models\Role::query()->forceDelete();
        $role =  \Tall\Acl\Models\Role::factory()->create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'special'=>'all-access'
        ]);
        
        $user->roles()->sync([$role->id->toString()]);
        $role =  [];
        $role[1] =  \Tall\Acl\Models\Role::factory()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special'=>'no-defined'
        ]);
        $role[2] =  \Tall\Acl\Models\Role::factory()->create([
            'name' => 'User',
            'slug' => 'user',
            'special'=>'no-defined'
        ]);
        $role[3] =  \Tall\Acl\Models\Role::factory()->create([
            'user_id' => 'Client',
            'name' => 'Client',
            'slug' => 'client',
            'special'=>'no-defined'
        ]);
        
        $role[4] =  \Tall\Acl\Models\Role::factory()->create([
            'name' => 'Restrict',
            'slug' => 'restrict',
            'special'=>'no-access'
        ]);

        \App\Models\User::factory(100)->create()->each(function($user) use($role){
            if(isset($role[rand(1,4)])){
                $model = $role[rand(1,4)];
                $model->user_id = $user->id;
                $model->update();
                $user->roles()->sync([$model->id->toString()]);
            }
        });          
    }
}
