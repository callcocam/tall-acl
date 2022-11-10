<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Route;
use Tall\Acl\Http\Livewire\FormComponent;
use Tall\Form\Fields\Field;

class ShowComponent extends FormComponent
{

    public function mount()
    {
        $this->setFormProperties(auth()->user(), Route::currentRouteName());
    }

    public function fields()
    {
        return [
            Field::make('Avatar','profile_photo_path','profile_photo_url'),
            Field::make('Name')->span('6'),
            Field::email('Email Address')->span('6'),
            Field::phone('phone')->span('6'),
        ];
    }

    protected function view($component="-component")
    {
        return 'tall::profile.show-component';
    }

    /**
     * @return Builder
     */
    protected function getFormField()
    {
        return [];
    }
}
