<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

use Tall\Acl\Models\Role;
use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;

class PermissionsComponent extends FormComponent
{

    public function mount(?Role $model)
    {
        $this->setFormProperties($model); 
        
    }

    protected function view(){
        return "acl::livewire.roles.permissions-component";
    }

    public function getPermissionsProperty(){
        return \Tall\Acl\Models\Permission::query()->get();
    }

    public function success()
    { 
        $this->model->permissions()->sync(array_filter(data_get($this->data,'permissions',[])));
        $this->notification()->success(
            $title = __('OPSS!!'),
            $description = __("Permissão atualizado com sucesso!!")
        );
    }
}
