<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;


use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;
use Tall\Acl\Contracts\IPermission;
use Tall\Acl\Contracts\IRole;
use Tall\Form\Fields\Field;

class EditComponent extends FormComponent
{
 
    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount($model)
    {

        $this->setFormProperties(app(IRole::class)->find($model), Route::currentRouteName());
    
    }

    protected function fields()
    {
        return [
            Field::make('Nome da role', 'name')->rules('required'),
            Field::radio('Tipo', 'special',array_combine(['all-access','no-access','no-defined'],['all-access','no-access','no-defined']))->rules('required'),
            Field::date('Data de criação','created_at')->span(6),
            Field::date('Última atualização', 'updated_at')->span(6),
            Field::checkbox('Permissões', 'permissions', app(IPermission::class)->pluck('name', 'id')->toArray())->multiple(true),
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
