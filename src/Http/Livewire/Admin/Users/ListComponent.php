<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use App\Models\User;
use Tall\Acl\Http\Livewire\TableComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Orm\Traits\Kill;

final class ListComponent extends TableComponent
{
    use AuthorizesRequests, Kill;
    
    public function mount()
    {
        $this->authorize(Route::currentRouteName());
       
    }
        
    /*
    |--------------------------------------------------------------------------
    |  Features query
    |--------------------------------------------------------------------------
    | Inicia a consulta ao banco de dados
    |
    */
    protected function query(){
         return User::query();
    }


    
    protected function view($component="-component"){
        return "tall::users.list-component";
    }

}
