<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Permissions;

use Tall\Acl\Models\Permission;
use Tall\Acl\Http\Livewire\TableComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

final class ListComponent extends TableComponent
{
    use AuthorizesRequests;
    
    public function mount()
    {
        $this->authorize(Route::currentRouteName());
    
        \Tall\Acl\LoadRouterHelper::save();
    }

    
    /*
    |--------------------------------------------------------------------------
    |  Features query
    |--------------------------------------------------------------------------
    | Inicia a consulta ao banco de dados
    |
    */
    protected function query(){
        return Permission::query();
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
           'tableTitle' => __('Permissions'),
       ];
    }
    
    protected function view(){
        return "tall-acl::livewire.permissions.list-component";
    }
}
