<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Roles;

use Tall\Acl\Contracts\IPermission;
use Tall\Acl\Models\Role;
use Tall\Acl\Http\Livewire\FormComponent;

class PermissionsComponent extends FormComponent
{

    public function mount(?Role $model)
    {
        $this->setFormProperties($model); 
        
    }
    protected function  view($sufix="-component"){
        return "tall::roles.permissions";
    }

    public function getPermissionsProperty(){
        return app()->make(IPermission::class)::query()->get();
    }

    public function success($callback = null)
    { 
        $this->model->permissions()->sync(array_filter(data_get($this->data,'permissions',[])));
        $this->notification()->success(
            $title = __('OPSS!!'),
            $description = __("Permissão atualizado com sucesso!!")
        );
    }
}
