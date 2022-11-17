<x-tall-acl.teams.action-section>
    <x-slot name="title">
        {{ __('Delete Team') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this team.') }}
    </x-slot>

    <x-slot name="content">
        <div class="w-full text-sm text-slate-700 dark:text-navy-200">
            {{ __('Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-tall-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                {{ __('Delete Team') }}
            </x-tall-danger-button>
        </div>

        <!-- Delete Team Confirmation Modal -->
        <x-tall-acl-dialog-modal maxWidth="lg" wire:model="confirmingTeamDeletion">
            <x-slot name="title">
                {{ __('Delete Team') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-tall-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-tall-secondary-button>

                <x-tall-danger-button class="ml-3" wire:click="deleteTeam" wire:loading.attr="disabled">
                    {{ __('Delete Team') }}
                </x-tall-danger-button>
            </x-slot>
        </x-tall-acl-dialog-modal>
    </x-slot>
</x-tall-acl.teams.action-section>
