<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Permissions;

use Tall\Acl\Http\Livewire\FormComponent;
use Tall\Acl\Contracts\IPermission;
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
    public function mount()
    {
        $this->setFormProperties(app()->make(IPermission::class)->make($this->blankModel()));

        
    }
    
    protected function fields()
    {
       
        return [
            Field::make('Nome da permissão', 'name')->rules('required')->span(6),
            Field::make('Chave', 'slug')->rules('required')->span(6),
            Field::textarea('Descrição','description'),
            Field::status(),
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
