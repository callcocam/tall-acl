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
        //Gate::authorize()

        $this->setFormProperties($model); // $user from hereon, called $this->model
       
    }

    protected function view(){
        return "tall-acl::livewire.users.roles-component";
    }

    protected function formAttr(): array
    {
        return [
           'formTitle' => __('User Roles'),
           'wrapWithView' => false,
           'showDelete' => false,
       ];
    }

    public function success()
    { 
        $this->model->roles()->sync(data_get($this->data,'access'));
    }
}
