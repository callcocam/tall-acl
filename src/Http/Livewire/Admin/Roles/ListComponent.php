<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

use Tall\Acl\Http\Livewire\TableComponent;
use Illuminate\Support\Facades\Route;
use Tall\Acl\Contracts\IRole as ContractsRole;
use Tall\Table\Fields\Column;
use Tall\Tenant\Contracts\ITenant;
use Tall\Tenant\Models\Landlord\Tenant;

final class ListComponent extends TableComponent
{
    
    public function mount()
    {

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

        return app(ContractsRole::class)->query()->when(isTenant(), function($builder){
            return $builder->tenants(get_tenant_id());
        });
    }

    protected function  view($sufix="-component"){
        return "tall::roles.list-component";
    }

    

    public function getImportProperty()
    {
        return 'tall::admin.roles.imports.csv-component';
    }
}
