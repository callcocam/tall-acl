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
        
        $this->setFormProperties(app()->make(IPermission::class)->find($model));

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
    
    protected function  view($sufix="-component"){
        return "tall::permissions.edit-component";
    }
}
