<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            {{ __('Dashboard') }}
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
            <li class="flex items-center space-x-2">
                <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                    href="#">{{ __('Team') }}</a>
                <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewbox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li>{{ __('Settings') }}</li>
        </ul>
    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">

        <div class="col-span-12">
            <div class="card">
                <div
                    class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        {{ __('Team Settings') }} {{ $team->name }}
                    </h2>
                </div>
                <div class="p-4 sm:p-5">
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
            </div>
        </div>
    </div>
</main>
