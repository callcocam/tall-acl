<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

use Illuminate\Support\Facades\Route;
use Tall\Acl\Contracts\IRole;
use Tall\Orm\Http\Livewire\DeleteComponent as LivewireDeleteComponent;


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
        $this->setFormProperties(app()->make(IRole::class)->find($model));
    }
    
    public function view($compnent="-component")
    {
        return 'tall::delete';
    }
}
