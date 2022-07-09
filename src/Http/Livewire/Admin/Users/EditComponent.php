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
use Illuminate\Validation\Rule;

class EditComponent extends FormComponent
{
    use AuthorizesRequests;

    use PasswordValidationRules;

    public $basic = true;
    
   
    protected function view(){
        return "tall-acl::livewire.users.edit-component";
    }
    /*
    |--------------------------------------------------------------------------
    |  Features mount
    |--------------------------------------------------------------------------
    | Inicia o formulario com um cadastro selecionado
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
            'email' => ['required', 'email', 'max:255', Rule::unique('users','email')->ignore($this->model->id)]
        ];
     }

    protected function success(){
        data_set($input,'password',data_get($this->data, "password"));
        data_set($input,'current_password',data_get($this->data, "current_password"));
        data_set($input,'password_confirmation',data_get($this->data, "password_confirmation"));
        if(collect($input)->filter(function($item){
            return !is_null($item);
        })->count()){
            $user = $this->model;
            Validator::make($input, [
                'current_password' => ['required', 'string'],
                'password' => $this->passwordRules(),
            ])->after(function ($validator) use ($user, $input) {
                if (!Hash::check(data_get($input,'current_password'), $user->password)) {
                    $validator->errors()->add('data.current_password', __('The provided password does not match your current password.'));
                }
            })->validate();       
            $this->data['password'] =Hash::make(data_get($input,'password')); 
            unset($this->data['current_password'], $this->data['password_confirmation']);       
            $input['password'] =  "";
            $input['current_password'] = "";
            $input['password_confirmation'] ="";            
            
            if(parent::success()){
                $this->data['password'] =""; 
                return true;
            }
            $this->data['password'] =""; 
            return false;
        }
        else{
          return parent::success();
        }
    }
    
}
