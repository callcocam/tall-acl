<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Users;

use Tall\Acl\Http\Livewire\FormComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use Tall\Acl\Contracts\IRole;
use Tall\Acl\Contracts\IUser;
use Tall\Form\Fields\Field;

class CreateComponent extends FormComponent
{

   
    use PasswordValidationRules;

    public $photo;

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
    public function mount(?IUser $model)
    {
        $this->setFormProperties($model); // $user from hereon, called $this->model
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

    protected function fields()
    {
        
        return [
            Field::make('Nome Completo', 'name')->span(6)->rules('required'),
            Field::make('E-Mail','email')->span(6)->rules('required'),
            Field::textarea('Informações adicional','description'),
            Field::date('Data de criação','created_at')->span(6),
            Field::date('Última atualização', 'updated_at')->span(6),
            Field::checkbox('Roles', 'access', app(IRole::class)
            ->when(isTenant(), function($builder){
                return $builder->tenants(get_tenant_id());
            })
            ->pluck('name', 'id')->toArray())->multiple(true),
        ];
    }
    
    public function span()
    {
        return '8';
    }
}
