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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateComponent extends FormComponent
{

    use AuthorizesRequests;
    use PasswordValidationRules;
    
    public $basic = false;

     
    /*
    |--------------------------------------------------------------------------
    |  Features format_view
    |--------------------------------------------------------------------------
    | Inicia as configurações basica do de nomes e rotas
    |
    */
    protected function view(){
        return "tall-acl::livewire.users.create-component";
    }

   /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro vasio
    |
    */
    public function mount(?User $model)
    {
        $this->authorize(Route::currentRouteName());   
        $this->setFormProperties($model); // $user from hereon, called $this->model
    }


    protected function rules(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ];
     }

    protected function success(){

        $this->data['password'] =  Hash::make($this->data['password']);  
        return parent::success();
    }


    /*
    |--------------------------------------------------------------------------
    |  Features saveAndGoBackResponse
    |--------------------------------------------------------------------------
    | Rota de redirecionamento apos a criação bem sucedida de um novo registro
    |
    */
    public function saveAndGoBackResponse()
    {
        return redirect()->route(config("acl.routes.users.edit"),$this->model);
    }
}
