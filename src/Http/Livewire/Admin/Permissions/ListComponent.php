<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Permissions;

use Illuminate\Support\Facades\Route;
use Tall\Acl\Models\Permission;
use Tall\Acl\Http\Livewire\TableComponent;
use Tall\Acl\LoadRouterHelper;
use Tall\Table\Fields\Column;

final class ListComponent extends TableComponent
{

    public function mount()
    {
        LoadRouterHelper::save();

        $this->authorize(Route::currentRouteName());

        $this->setUp(Route::currentRouteName());
    }
    
     
    /**
     * Função para trazer uma lista de colunas (opcional)
     * Geralmente usada com um component de table dinamicas
     * Voce pode sobrescrever essas informações no component filho 
     */
    public function columns(){
        return [
            Column::make('Name'),
            Column::actions([
                Column::make('Edit')->icon('pencil')->route('admin.permissions.edit'),
                Column::make('Delete')->icon('trash')->route('admin.permissions.delete'),
            ]),

        ];
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
    
    protected function  view($sufix="-component"){
        return "tall::permissions.list-component";
    }
}
