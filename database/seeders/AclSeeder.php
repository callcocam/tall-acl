<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tall\Acl\Models\Role;

class AclSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         /**
         *@var $model Builder
         */
        $userModel = app(User::class);
        
        $userModel->query()->forceDelete();
        $user =   $userModel->factory()->create([
            'name' => 'Landlord User',
            'email' => 'landlord@example.com',
        ]);
        /**
         *@var $model Builder
         */
        $modelRole = app(Role::class);

        $modelRole->query()->forceDelete();
        $role =  $modelRole->factory()->create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'special'=>'all-access'
        ]);
        
        $user->roles()->sync([$role->id]);
        $role =  [];
        $role[1] =  $modelRole->factory()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special'=>'no-defined'
        ]);
        $role[2] =  $modelRole->factory()->create([
            'name' => 'User',
            'slug' => 'user',
            'special'=>'no-defined'
        ]);
        $role[3] =  $modelRole->factory()->create([
            'user_id' => 'Client',
            'name' => 'Client',
            'slug' => 'client',
            'special'=>'no-defined'
        ]);
        
        $role[4] =  $modelRole->factory()->create([
            'name' => 'Restrict',
            'slug' => 'restrict',
            'special'=>'no-access'
        ]);

        // $userModel->factory(100)->create()->each(function($user) use($role){
        //     if(isset($role[rand(1,4)])){
        //         $model = $role[rand(1,4)];
        //         $model->user_id = $user->id;
        //         $model->update();
        //         $user->roles()->sync([$model->id]);
        //     }
        // });          
    }
}
