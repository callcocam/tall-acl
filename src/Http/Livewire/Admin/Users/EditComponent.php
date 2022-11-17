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
use App\Actions\Fortify\PasswordValidationRules;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Tall\Form\Fields\Field;

class EditComponent extends FormComponent
{

    use PasswordValidationRules;

    public $photo;

    public $basic = true;
    
   
    protected function  view($sufix="-component"){
        return "tall::users.edit-component";
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
        $this->setFormProperties($model, Route::currentRouteName());
    }

    protected function fields()
    {
       
        return [
            Field::make('Nome Completo', 'name')->span(6)->rules('required'),
            Field::make('E-Mail','email')->span(6)->rules('required'),
            Field::textarea('Informações adicional','description'),
            Field::date('Data de criação','created_at')->span(6),
            Field::date('Última atualização', 'updated_at')->span(6),
        ];
    }
    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update($this->model,array_merge($this->form_data, ['photo' => $this->photo]) ?? []);

        return redirect()->route('admin.user.edit', $this->model);
    }

    
}
