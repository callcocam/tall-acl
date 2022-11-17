<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Acl\Http\Livewire\Admin\Profile\Teams\Manage;

use Illuminate\Support\Facades\Auth;
use Tall\Acl\Contracts\CreatesTeams;
use Livewire\Component;
use Tall\Acl\RedirectsActions;

class CreateTeamForm extends Component
{
    use RedirectsActions;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Create a new team.
     *
     * @param  \Tall\Acl\Contracts\CreatesTeams  $creator
     * @return void
     */
    public function createTeam(CreatesTeams $creator)
    {
        $this->resetErrorBag();

        $creator->create(Auth::user(), $this->state);

        return $this->redirectPath($creator);
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Define o layout para o component acessa via rota
     * Voce pode sobrescrever essas informações no component filho
     */
    protected function layout(){

        return "tall::layouts.app";

    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('tall::profile.teams.manage.create-team-form')->layout($this->layout());
    }
}
