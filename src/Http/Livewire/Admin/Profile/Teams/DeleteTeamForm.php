<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Profile\Teams;

use Illuminate\Support\Facades\Auth;
use Tall\Acl\RedirectsActions;
use Tall\Acl\Actions\ValidateTeamDeletion;
use Tall\Acl\Contracts\DeletesTeams;
use Livewire\Component;

class DeleteTeamForm extends Component
{
    use RedirectsActions;

    /**
     * The team instance.
     *
     * @var mixed
     */
    public $team;

    /**
     * Indicates if team deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingTeamDeletion = false;

    /**
     * Mount the component.
     *
     * @param  mixed  $team
     * @return void
     */
    public function mount($team)
    {
        $this->team = $team;
    }

    /**
     * Delete the team.
     *
     * @param  \Tall\Acl\Actions\ValidateTeamDeletion  $validator
     * @param  \Tall\Acl\Contracts\DeletesTeams  $deleter
     * @return void
     */
    public function deleteTeam(ValidateTeamDeletion $validator, DeletesTeams $deleter)
    {
        $validator->validate(Auth::user(), $this->team);

        $deleter->delete($this->team);

        return $this->redirectPath($deleter);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tall::profile.teams.delete-team-form');
    }
}
