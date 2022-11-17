<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Profile\Teams\Manage;

use Illuminate\Support\Facades\Gate;
use Tall\Acl\Teams\Jetstream;
use Livewire\Component;
class ShowComponent extends Component
{


    public $team;

    public function mount($teamId)
    {
        $this->team = Jetstream::newTeamModel()->findOrFail($teamId);
        
        if (Gate::denies('view', $this->team)) {
            abort(403);
        }

    }


    /**
     * Define o layout para o component acessa via rota
     * Voce pode sobrescrever essas informações no component filho
     */
    protected function layout(){

        return "tall::layouts.app";

    }


    public function render()
    {
        return view('tall::profile.teams.manage.show-component',[
            'user' => auth()->user(),
            'team' =>  $this->team
        ])->layout($this->layout());
    }
}
