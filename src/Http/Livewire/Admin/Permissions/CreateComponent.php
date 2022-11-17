<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Permissions;

use Tall\Acl\Models\Permission;
use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;
use Tall\Acl\Contracts\Permission as ContractsPermission;
use Tall\Cms\Models\Make;
use Tall\Form\Fields\Field;

class CreateComponent extends FormComponent
{


    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro vasio
    |
    */
    public function mount(?Permission $model)
    {
        
        $this->setConfigProperties(new Make([
            'name'=>'Permissions',
            'route'=>'admin.permissions'
        ]));
        $this->setFormProperties(app(ContractsPermission::class), Route::currentRouteName());
    }
    
    protected function fields()
    {
       
        return [
            Field::make('Nome da role', 'name')->rules('required'),
            Field::date('Data de criação','created_at')->span(6),
            Field::date('Última atualização', 'updated_at')->span(6)
        ];
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Features saveAndGoBackResponse
    |--------------------------------------------------------------------------
    | Rota de redirecionamento apos a criação bem sucedida de um novo registro
    |
    */
     /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAndGoBackResponse()
    {
          return redirect()->route('admin.permissions.edit', $this->model);
    }
    
    protected function  view($sufix="-component"){
        return "tall::permissions.create-component";
    }
}
