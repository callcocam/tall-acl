<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use App\Models\Address;
use App\Models\User;
use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;

class AddressComponent extends FormComponent
{

    public function mount(?User $model)
    {
        $this->setFormProperties($model->address()->firstOrCreate()); // $user from hereon, called $this->model
    }

    protected function view(){
        return "tall-acl::livewire.users.address-component";
    }
    protected function formAttr(): array
    {
        return [
           'formTitle' => __('User Address'),
           'wrapWithView' => false,
           'showDelete' => false,
       ];
    }

}
