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
        $this->setFormProperties($model->address()->firstOrCreate()); 
    }

    protected function view(){
        return "tall-acl::livewire.users.address-component";
    }


    public function getStatesProperty()
    {
        return [
            "AC"=>"Acre",
            "AL"=>"Alagoas",
            "AP"=>"Amapá",
            "AM"=>"Amazonas",
            "BA"=>"Bahia",
            "CE"=>"Ceará",
            "ES"=>"Espírito Santo",
            "GO"=>"Goiás",
            "MA"=>"Maranhão",
            "MT"=>"Mato Grosso",
            "MS"=>"Mato Grosso do Sul",
            "MG"=>"Minas Gerais",
            "PA"=>"Pará",
            "PB"=>"Paraíba",
            "PR"=>"Paraná",
            "PE"=>"Pernambuco",
            "PI"=>"Piauí",
            "RJ"=>"Rio de Janeiro",
            "RN"=>"Rio Grande do Norte",
            "RS"=>"Rio Grande do Sul",
            "RO"=>"Rondônia",
            "RR"=>"Roraima",
            "SC"=>"Santa Catarina",
            "TO"=>"São Paulo",
            "SE"=>"Sergipe",
            "DF"=>"Distrito Federal"
         ];
    }

}
