<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use App\Models\User;
use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;

class RolesComponent extends FormComponent
{

    public function mount(?User $model)
    {
        $this->setFormProperties($model); // $user from hereon, called $this->model
        
    }

    protected function view($component = '-component'){
        return "tall::users.roles-component";
    }

    public function getRolesProperty(){
        return \Tall\Acl\Models\Role::query()->get();
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
