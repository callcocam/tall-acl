<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

use Tall\Acl\Models\Role;
use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Acl\Contracts\Role as ContractsRole;
use Tall\Cms\Models\Make;
use Tall\Form\Fields\Field;

class CreateComponent extends FormComponent
{

    use AuthorizesRequests;

   /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro vasio
    |
    */
    public function mount(?Role $model)
    {
        $this->authorize(Route::currentRouteName());
        
        $this->setConfigProperties(new Make([
            'name'=>'Roles',
            'route'=>'admin.roles'
        ]));
        $this->setFormProperties(app(ContractsRole::class),Route::currentRouteName()); 
    }
    
    
    protected function fields()
    {
       
        return [
            Field::make('Nome da role', 'name')->rules('required'),
            Field::radio('Tipo', 'special',array_combine(['all-access','no-access','no-defined'],['all-access','no-access','no-defined']))->rules('required'),
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
          return redirect()->route('admin.roles.edit', $this->model);
    }
    
    protected function  view($sufix="-component"){
        return "tall::roles.create-component";
    }
}
