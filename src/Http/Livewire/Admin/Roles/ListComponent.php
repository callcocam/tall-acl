<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

use Tall\Acl\Http\Livewire\TableComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tall\Acl\Contracts\Role as ContractsRole;
use Tall\Cms\Models\Make;
use Tall\Table\Fields\Column;

final class ListComponent extends TableComponent
{
    use AuthorizesRequests;
    
    public function mount()
    {
        $this->authorize(Route::currentRouteName());

        $this->setConfigProperties(new Make([
            'name'=>'Roles',
            'route'=>'admin.roles'
        ]));
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
                Column::make('Edit')->icon('pencil')->route('admin.roles.edit'),
                Column::make('Delete')->icon('trash')->route('admin.roles.delete'),
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
        return app(ContractsRole::class)->query();
    }

    protected function  view($sufix="-component"){
        return "tall::roles.list-component";
    }
}
