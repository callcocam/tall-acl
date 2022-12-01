<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Permissions;

use Illuminate\Support\Facades\Route;
use Tall\Acl\Contracts\IPermission;
use Tall\Orm\Http\Livewire\DeleteComponent as LivewireDeleteComponent;

// use Tall\Orm\Http\Livewire\ConfirmComponent;

class DeleteComponent extends LivewireDeleteComponent
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
        $this->setFormProperties(app()->make(IPermission::class)->find($model), Route::currentRouteName());
    }
    
    public function view($compnent="-component")
    {
        return 'tall::delete';
    }
}
