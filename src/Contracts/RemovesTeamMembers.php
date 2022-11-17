<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tall\Acl\Contracts;

interface RemovesTeamMembers
{
    /**
     * Remove the team member from the given team.
     *
     * @param  mixed  $user
     * @param  mixed  $team
     * @param  mixed  $teamMember
     * @return void
     */
    public function remove($user, $team, $teamMember);
}
