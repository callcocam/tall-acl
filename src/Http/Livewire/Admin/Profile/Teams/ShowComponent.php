<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Profile\Teams;

use Tall\Acl\Teams\Jetstream;
use Livewire\Component;
class ShowComponent extends Component
{


    // public $team;

    // public function mount()
    // {
    //     $this->team = Jetstream::newTeamModel()->findOrFail(auth()->user()->current_team_id);

    // }



    public function render()
    {
        return view('tall::profile.teams.show-component',[
            'user' => auth()->user(),
            'team' =>  Jetstream::newTeamModel()->findOrFail(auth()->user()->current_team_id)
        ]);
    }
}
