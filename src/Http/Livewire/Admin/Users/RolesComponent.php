<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use Tall\Acl\Contracts\IRole;
use Tall\Acl\Contracts\IUser;
use Tall\Acl\Http\Livewire\FormComponent;

class RolesComponent extends FormComponent
{

    public function mount($model)
    {
        $this->setFormProperties(app(IUser::class)->find($model));
        
    }

    protected function view($component = '-component'){
        return "tall::users.roles-component";
    }

    public function getRolesProperty(){
        return app()->make(IRole::class)::query()->get();
    }

    public function success($callback = null)
    { 
        $this->model->roles()->sync(array_filter(data_get($this->data,'access',[])));
        $this->notification()->success(
            $title = __('OPSS!!'),
            $description = __("Roles atualizado com sucesso!!")
        );
    }
}
