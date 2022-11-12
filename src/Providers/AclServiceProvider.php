<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Providers;

use Tall\Acl\Models\Permission as ModelsPermission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tall\Acl\Console\Commands\AclCommand;
use Tall\Acl\Contracts\Permission;
use Tall\Acl\Contracts\Role;
use Tall\Acl\Contracts\User;
use Tall\Acl\Models\Role as ModelsRole;
use Tall\Acl\Models\User as ModelsUser;

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

            if(class_exists('App\Models\User')){
                $this->app->bind(User::class, 'App\Models\User');
            }
            else{
                    $this->app->bind(User::class, ModelsUser::class);
            }

            if(class_exists('App\Models\Permission')){
                $this->app->bind(Permission::class, 'App\Models\Permission');
            }
            else{
                    $this->app->bind(Permission::class, ModelsPermission::class);
            }
            if(class_exists('App\Models\Role')){
            $this->app->bind(Role::class, 'App\Models\Role');
            }
            else{
                $this->app->bind(Role::class, ModelsRole::class);
            }
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
        if(class_exists('\Tall\Theme\Providers\ThemeServiceProvider')){
            \Tall\Theme\Providers\ThemeServiceProvider::configureDynamicComponent(__DIR__."/../../resources/views/components");

            if(is_dir(resource_path("views/vendor/tall/acl/components"))){
                \Tall\Theme\Providers\ThemeServiceProvider::configureDynamicComponent(resource_path("views/vendor/tall/acl/components"));
            }
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
           
        //PRFILE ADMIN
        Livewire::component( 'tall::admin.profile.show-component', \Tall\Acl\Http\Livewire\Admin\Profile\ShowComponent::class);
        Livewire::component( 'tall::admin.profile.update-profile-information-form', \Tall\Acl\Http\Livewire\Admin\Profile\UpdateProfileInformationForm::class);
        Livewire::component( 'tall::admin.profile.update-profile-photo-form', \Tall\Acl\Http\Livewire\Admin\Profile\UpdateProfilePhotoForm::class);
        Livewire::component( 'tall::admin.profile.update-password-form', \Tall\Acl\Http\Livewire\Admin\Profile\UpdatePasswordForm::class);
        Livewire::component( 'tall::admin.profile.two-factor-authentication-form', \Tall\Acl\Http\Livewire\Admin\Profile\TwoFactorAuthenticationForm::class);
        Livewire::component( 'tall::admin.profile.logout-other-browser-sessions-form', \Tall\Acl\Http\Livewire\Admin\Profile\LogoutOtherBrowserSessionsForm::class);
        Livewire::component( 'tall::admin.profile.delete-user-form', \Tall\Acl\Http\Livewire\Admin\Profile\DeleteUserForm::class);
        
        
        Livewire::component( 'tall::users.delete-component', \Tall\Acl\Http\Livewire\Admin\Users\DeleteComponent::class);
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
