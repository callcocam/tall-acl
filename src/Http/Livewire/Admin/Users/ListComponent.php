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

final class ListComponent extends TableComponent
{
    use AuthorizesRequests;
    
    public function mount()
    {
        $this->authorize(Route::currentRouteName());
       
    }
        
    
    public function ordering(){
        return 1;
    }

    //     /*
    // |--------------------------------------------------------------------------
    // |  Features label
    // |--------------------------------------------------------------------------
    // | Label visivel no me menu
    // |
    // */
    public function label(){
      
        return "Usuários";
     }

    /*
    |--------------------------------------------------------------------------
    |  Features route
    |--------------------------------------------------------------------------
    | Rota create do crud, cadastrar um novo registro
    |
    */
    public function getCreateProperty()
    {
        return config("acl.routes.users.create");
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

     /*
    |--------------------------------------------------------------------------
    |  Features tableAttr
    |--------------------------------------------------------------------------
    | Inicia as configurações basica do table
    |
    */
    protected function tableAttr(): array
    {
        return [
           'tableTitle' => __('Users'),
       ];
    }

    
    protected function view(){
        return "acl::livewire.users.list-component";
    }

}
