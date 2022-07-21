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
        \Tall\Acl\Models\Role::query()->forceDelete();
        $role =  \Tall\Acl\Models\Role::factory()->create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'special'=>'all-access'
        ]);
        $user->roles()->sync([$role->id->toString()]);
        \App\Models\User::factory(100)->create();      
    }
}
