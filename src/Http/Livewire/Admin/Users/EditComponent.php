<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\PasswordValidationRules;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Tall\Acl\Contracts\IRole;
use Tall\Acl\Contracts\IUser;
use Tall\Form\Fields\Field;

class EditComponent extends FormComponent
{

    use PasswordValidationRules;

    public $photo;

    public $basic = true;
    
   
    protected function  view($sufix="-component"){
        return "tall::users.edit-component";
    }
    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount($model)
    {
        $this->setFormProperties(app()->make(IUser::class)->find($model), Route::currentRouteName());
        
    }

    protected function fields()
    {
        
        return [
            Field::make('Nome Completo', 'name')->span(6)->rules('required'),
            Field::make('E-Mail','email')->span(6)->rules('required'),
            Field::textarea('Informações adicional','description'),
            Field::date('Data de criação','created_at')->span(6),
            Field::date('Última atualização', 'updated_at')->span(6),
            Field::checkbox('Roles', 'access', app(IRole::class)
            ->when(isTenant(), function($builder){
                return $builder->tenants(get_tenant_id());
            })
            ->pluck('name', 'id')->toArray())->multiple(true),
        ];
    }
    
    public function success($callback = null)
    {
        parent::success($callback);

        $this->model->roles()->sync(data_get($this->form_data, 'access'));

        return true;
    }
    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update($this->model,array_merge($this->form_data, ['photo' => $this->photo]) ?? []);

        return redirect()->route('admin.user.edit', $this->model);
    }

    public function span()
    {
        return '8';
    }
    
}
