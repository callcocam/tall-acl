<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use Tall\Acl\Http\Livewire\TableComponent;
use Illuminate\Support\Facades\Route;
use Tall\Acl\Contracts\IUser;
use Tall\Orm\Traits\Kill;
use Tall\Table\Fields\Column;

final class ListComponent extends TableComponent
{
    use Kill;
    
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
            Column::make('Email'),
            Column::actions([
                Column::make('Edit')->icon('pencil')->route('admin.users.edit'),
                Column::make('Delete')->icon('trash')->route('admin.users.delete'),
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
         return app()->make(IUser::class)::query();
    }


    
    protected function view($component="-component"){
        return "tall::users.list-component";
    }


    public function getImportProperty()
    {
        return 'tall::admin.users.imports.csv-component';
    }
}
