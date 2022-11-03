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
        $this->setFormProperties($model, Route::currentRouteName());
    }

    protected function  view($sufix="-component"){
        return "acl::livewire.roles.edit-component";
    }
   
}
