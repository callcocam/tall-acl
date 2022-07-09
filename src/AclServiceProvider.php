<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use Livewire\Livewire;
use Symfony\Component\Finder\Finder;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
        $this->app->register(RouteServiceProvider::class);
    }

   /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
               
        $this->bootViews();
        $this->publishConfig();
        $this->loadConfigs();
        $this->publishMigrations();
        $this->loadMigrations();
        $this->registerGates();
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-acl');
       
        Livewire::component( 'tall-acl::users.roles-component', \Tall\Acl\Http\Livewire\Admin\Users\RolesComponent::class);
        Livewire::component( 'tall-acl::users.address-component', \Tall\Acl\Http\Livewire\Admin\Users\AddressComponent::class);
        Livewire::component( 'tall-acl::roles.permissions-component', \Tall\Acl\Http\Livewire\Admin\Roles\PermissionsComponent::class);
        
        Livewire::component( 'tall-acl::users.list-component', \Tall\Acl\Http\Livewire\Admin\Users\ListComponent::class);
        Livewire::component( 'tall-acl::roles.list-component', \Tall\Acl\Http\Livewire\Admin\Roles\ListComponent::class);
        Livewire::component( 'tall-acl::permissions.list-component', \Tall\Acl\Http\Livewire\Admin\Permissions\ListComponent::class);

        Livewire::component( 'tall-acl::users.create-component', \Tall\Acl\Http\Livewire\Admin\Users\CreateComponent::class);
        Livewire::component( 'tall-acl::roles.create-component', \Tall\Acl\Http\Livewire\Admin\Roles\CreateComponent::class);
        Livewire::component( 'tall-acl::permissions.create-component', \Tall\Acl\Http\Livewire\Admin\Permissions\CreateComponent::class);

        Livewire::component( 'tall-acl::users.edit-component', \Tall\Acl\Http\Livewire\Admin\Users\EditComponent::class);
        Livewire::component( 'tall-acl::roles.edit-component', \Tall\Acl\Http\Livewire\Admin\Roles\EditComponent::class);
        Livewire::component( 'tall-acl::permissions.edit-component', \Tall\Acl\Http\Livewire\Admin\Permissions\EditComponent::class);
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
            __DIR__.'/../config/acl.php' => config_path('acl.php'),
        ], 'tall-form');

        
    }

    
     /**
     * Merge the config file.
     *
     * @return void
     */
    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/acl.php','acl');
    }



    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'acl-migrations');
        
        $this->publishes([
            __DIR__.'/../database/factories/' => database_path('factories'),
        ], 'acl-factories');
        
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        if (config('report.migrate', true)) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

}
