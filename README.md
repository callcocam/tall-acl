#TAL ACL TABLE

Pacote de contro de acesso

#ALTERAR A TABLE SESSIONS

```
Schema::create('sessions', function (Blueprint $table) {
    ...
   //$table->foreignId('user_id')->nullable()->index();
    $table->foreignUuid('user_id')->nullable()->index();
    ...
});

tambem pode dar alguns comflitos com a tabela de users

Schema::create('users', function (Blueprint $table) {
    //$table->id();
    $table->uuid('id')->primary();//Mudaa para uuid
   ...
});

```

#UPDATE MODEL USER
```
    //ADD
    public $incrementing = false;

    protected $keyType = "string";

    //REMOVE OR COMENT
        // protected $fillable = [
        //     'name',
        //     'email',
        //     'password',
        // ];

    // ADD
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();        
        static::creating(function ($model) {
            if (is_null($model->id)):
                $model->id = \Ramsey\Uuid\Uuid::uuid4();
            endif;
        });
    }


```

#ALTERANDO o TAILWIND CONFIG
```
....
module.exports = {
   ...
    content: [
        ...
        './vendor/callcocam/tall-acl/resources/views/**/*.blade.php',
        ....
    ],
....
};
    
```
#PUBLICAR AS FACTORIES E SEEDERS

```
./vendor/bin/sail artisan vendor:publish --tag=acl-factories --force
 or 
sail artisan vendor:publish --tag=acl-factories --force

EXAMPLE:

if(class_exists(\Tall\Form\Models\Status::class)){
    \Tall\Form\Models\Status::factory()->create([
        'name'=>'Published'
    ]);
    \Tall\Form\Models\Status::factory()->create([
        'name'=>'Draft'
    ]);
}
if(class_exists(\Tall\Tenant\Models\Tenant::class)){
    $host = \Str::replace("www.",'',request()->getHost());
    \Tall\Tenant\Models\Tenant::factory()->create([
        'name'=> 'Base',
        'domain'=> $host,
        'database'=>env("DB_DATABASE","landlord"),
        'prefix'=>'landlord',
        'middleware'=>'landlord',
        'provider'=>'mysql',
    ]);
}

\App\Models\User::query()->forceDelete();    
$user =   \App\Models\User::factory()->create([
    'name' => 'Test User',
    'email' => 'test@example.com',
]);

\App\Models\User::query()->forceDelete();
\Tall\Acl\Models\Role::query()->forceDelete();

  $admin =   \App\Models\User::factory()->create([
      'name' => 'Test Admin',
      'email' => 'admin@example.com',
  ]);

  $roleAdmin =  \Tall\Acl\Models\Role::factory()->create([
      'name' => 'Super Admin',
      'slug' => 'super-admin',
      'special'=>'all-access'
  ]);
  $admin->roles()->sync([$roleAdmin->id->toString()]);   

   $user =   \App\Models\User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
  ]);
 
  $role =  \Tall\Acl\Models\Role::factory()->create([
      'name' => 'User',
      'slug' => 'user',
      'special'=>'no-access'
  ]);
  $user->roles()->sync([$role->id->toString()]);   


  \App\Models\User::factory(100)->create();

```