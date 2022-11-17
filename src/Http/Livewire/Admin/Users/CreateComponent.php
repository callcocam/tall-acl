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
use App\Actions\Fortify\PasswordValidationRules;

class CreateComponent extends FormComponent
{

    use PasswordValidationRules;
    
    public $basic = false;

     
    /*
    |--------------------------------------------------------------------------
    |  Features format_view
    |--------------------------------------------------------------------------
    | Inicia as configurações basica do de nomes e rotas
    |
    */
    protected function  view($sufix="-component"){
        return "tall::users.create-component";
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
        $this->setFormProperties($model, Route::currentRouteName()); // $user from hereon, called $this->model
    }
    
    protected function success($callback=null){

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
        return redirect()->route('admin.userr.create',$this->model);
    }
}
