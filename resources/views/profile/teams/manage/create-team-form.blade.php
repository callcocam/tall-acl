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
                        {{ __('Create Team') }}
                    </h2>
                </div>
                <div class="p-4 sm:p-5">
                    <x-tall-acl.teams.form-section submit="createTeam">
                        <x-slot name="title">
                            {{ __('Team Details') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Create a new team to collaborate with others on projects.') }}
                        </x-slot>

                        <x-slot name="form">
                            <div class="col-span-6">
                                <x-tall-input.label-sample value="{{ __('Team Owner') }}" />

                                <div class="flex items-center mt-2">
                                    <img class="w-12 h-12 rounded-full object-cover"
                                        src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">

                                    <div class="ml-4 leading-tight">
                                        <div>{{ $this->user->name }}</div>
                                        <div class="text-slate-700 dark:text-navy-300  text-sm">
                                            {{ $this->user->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-5">
                                <x-tall-input.label-sample for="name" value="{{ __('Team Name') }}" />
                                <x-tall-input.text id="name" type="text" wire:model.defer="state.name"
                                    autofocus />
                                <x-tall-input.error for="name" class="mt-2" />
                            </div>
                        </x-slot>

                        <x-slot name="actions">
                            <x-jet-button>
                                {{ __('Create') }}
                            </x-jet-button>
                        </x-slot>
                    </x-tall-acl.teams.form-section>
                </div>
            </div>
        </div>
    </div>
</main>
