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

class EditComponent extends FormComponent
{
 
    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount(?Permission $model)
    {
        
        $this->setFormProperties(app(ContractsPermission::class)->find($model->id));

     }

    protected function fields()
    {
       
        return [
            Field::make('Nome da role', 'name')->rules('required'),
            Field::quill('Descrição','description'),
            Field::date('Data de criação','created_at')->span(6),
            Field::date('Última atualização', 'updated_at')->span(6)
        ];
    }
    
    protected function  view($sufix="-component"){
        return "tall::permissions.edit-component";
    }
}
