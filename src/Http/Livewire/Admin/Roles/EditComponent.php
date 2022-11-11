<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

// use App\Models\Role;

use App\Models\Make;
use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Acl\Contracts\Permission;
use Tall\Acl\Contracts\Role as ContractsRole;
use Tall\Acl\Models\Role;
use Tall\Form\Fields\Field;

class EditComponent extends FormComponent
{
 
    use AuthorizesRequests;
    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount(?Role $model)
    {
        $this->authorize(Route::currentRouteName());


        $this->setFormProperties(app(ContractsRole::class)->find($model->id), Route::currentRouteName());
    
    }

    protected function fields()
    {
        return [
            Field::make('Nome da role', 'name')->rules('required'),
            Field::radio('Tipo', 'special',array_combine(['all-access','no-access','no-defined'],['all-access','no-access','no-defined']))->rules('required'),
            Field::date('Data de criação','created_at')->span(6),
            Field::date('Última atualização', 'updated_at')->span(6),
            Field::checkbox('Permissões', 'permissions', app(Permission::class)->pluck('name', 'id')->toArray()),
        ];
    }


    public function success($callback = null)
    {
        if(parent::success($callback)){
          $this->model->permissions()->sync(data_get($this->form_data, 'permissions'));
        }
        return true;
    }
    protected function  view($sufix="-component"){
        return "tall::roles.edit-component";
    }
   
}
