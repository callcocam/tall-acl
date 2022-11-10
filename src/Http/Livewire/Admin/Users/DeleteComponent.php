<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use App\Models\User;

use Tall\Orm\Http\Livewire\ConfirmComponent;

class DeleteComponent extends ConfirmComponent
{    
   
    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
    |
    */
    public function mount(?User $model)
    {
        $this->setFormProperties($model);
    }
    
}
