<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Events;

use Illuminate\Foundation\Events\Dispatchable;

class AddingTeamMember
{
    use Dispatchable;

    /**
     * The team instance.
     *
     * @var mixed
     */
    public $team;

    /**
     * The team member being added.
     *
     * @var mixed
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param  mixed  $team
     * @param  mixed  $user
     * @return void
     */
    public function __construct($team, $user)
    {
        $this->team = $team;
        $this->user = $user;
    }
}
