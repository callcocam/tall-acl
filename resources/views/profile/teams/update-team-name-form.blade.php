<x-tall-acl.teams.form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="flex flex-col space-y-2">
            <x-jet-label class="text-slate-700 dark:text-navy-300 text-sm" value="{{ __('Team Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}"
                    alt="{{ $team->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $team->owner->name }}</div>
                    <div class=" text-slate-700 dark:text-navy-100 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-tall-input.label for="name" value="{{ __('Team Name') }}">

                <x-tall-input.text id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                    :disabled="!Gate::check('update', $team)" />

                <x-jet-input-error for="name" class="mt-2" />
            </x-tall-input.label>
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    @endif
</x-tall-acl.teams.form-section>
