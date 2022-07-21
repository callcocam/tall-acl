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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
    public function mount(?Permission $model)
    {
        $this->authorize(Route::currentRouteName());
        $this->setFormProperties($model); // $permission from hereon, called $this->model
    }

    
    protected function rules(){
        return [
             'name'=>'required'
        ];
     }

    
    protected function view(){
        return "tall-acl::livewire.permissions.edit-component";
    }
}
