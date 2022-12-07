<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

use Tall\Acl\Http\Livewire\FormComponent;
use Tall\Acl\Contracts\IRole;
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
    public function mount(?IRole $model)
    {
        $this->setFormProperties(app($model)); 
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
