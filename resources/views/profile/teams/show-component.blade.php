<div>
    @if (!Gate::denies('view', $team))

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Team Settings') }}
            </h2>
        </x-slot>

        <div>
            <div class="mx-auto py-10 sm:px-6 lg:px-8">
                @livewire('tall::admin.profile.teams.update-team-name-form', ['team' => $team])

                @livewire('tall::admin.profile.teams.team-member-manager', ['team' => $team])

                @if (Gate::check('delete', $team) && !$team->personal_team)
                    <x-jet-section-border />

                    <div class="mt-10 sm:mt-0">
                        @livewire('tall::admin.profile.teams.delete-team-form', ['team' => $team])
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
