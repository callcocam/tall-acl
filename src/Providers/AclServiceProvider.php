<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tall\Acl\Console\Commands\AclCommand;

class AclServiceProvider extends ServiceProvider
{
  /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if(trait_exists(\App\Actions\Fortify\PasswordValidationRules::class))
           $this->app->register(RouteServiceProvider::class);
    }

   /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(trait_exists(\App\Actions\Fortify\PasswordValidationRules::class)){
            $this->registerCommands();
            $this->bootViews();
            $this->publishConfig();
            $this->loadConfigs();
            $this->publishMigrations();
            $this->loadMigrations();
            $this->registerGates();
        }
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'tall');
       
        Livewire::component( 'tall::users.roles-component', \Tall\Acl\Http\Livewire\Admin\Users\RolesComponent::class);
        Livewire::component( 'tall::users.address-component', \Tall\Acl\Http\Livewire\Admin\Users\AddressComponent::class);
        Livewire::component( 'tall::roles.permissions-component', \Tall\Acl\Http\Livewire\Admin\Roles\PermissionsComponent::class);
        
        Livewire::component( 'tall::users.list-component', \Tall\Acl\Http\Livewire\Admin\Users\ListComponent::class);
        Livewire::component( 'tall::roles.list-component', \Tall\Acl\Http\Livewire\Admin\Roles\ListComponent::class);
        Livewire::component( 'tall::permissions.list-component', \Tall\Acl\Http\Livewire\Admin\Permissions\ListComponent::class);

        Livewire::component( 'tall::users.create-component', \Tall\Acl\Http\Livewire\Admin\Users\CreateComponent::class);
        Livewire::component( 'tall::roles.create-component', \Tall\Acl\Http\Livewire\Admin\Roles\CreateComponent::class);
        Livewire::component( 'tall::permissions.create-component', \Tall\Acl\Http\Livewire\Admin\Permissions\CreateComponent::class);

        Livewire::component( 'tall::users.edit-component', \Tall\Acl\Http\Livewire\Admin\Users\EditComponent::class);
        Livewire::component( 'tall::roles.edit-component', \Tall\Acl\Http\Livewire\Admin\Roles\EditComponent::class);
        Livewire::component( 'tall::permissions.edit-component', \Tall\Acl\Http\Livewire\Admin\Permissions\EditComponent::class);
    }
    /**
     * Register the permission gates.
     *
     * @return void
     */
    protected function registerGates()
    {
        Gate::before(function (Authorizable $user, $permission) {
            try {
                if (method_exists($user, 'hasPermissionTo')) {
                    return $user->hasPermissionTo($permission) ?: null;
                }
            } catch (\Exception $e) {
                //dd($e);
            }
        });
    }

     /**
     * Publish the config file.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/acl.php' => config_path('acl.php'),
        ], 'acl-config');

        
    }

    
     /**
     * Merge the config file.
     *
     * @return void
     */
    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/acl.php','acl');
    }



    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations'),
        ], 'acl-migrations');
        
        $this->publishes([
            __DIR__.'/../../database/factories/' => database_path('factories'),
        ], 'acl-factories');
        
        $this->publishes([
            __DIR__.'/../../database/seeders/' => database_path('seeders'),
        ], 'acl-seeder');
        
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        if (config('acl.migrate', false)) {
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        }
    }


    protected function registerCommands()
    {
        if (! $this->app->runningInConsole()) return;

        $this->commands([
            AclCommand::class, // make:livewire
        ]);
    }
}
