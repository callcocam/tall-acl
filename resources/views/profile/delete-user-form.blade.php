<x-tall-acl-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-slate-600 dark:text-navy-100">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-tall-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-tall-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-tall-acl-dialog-modal  maxWidth="lg" wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    @if ($field = field(__('Password'), 'password'))
                        <x-tall-label for="password" :field="$field">
                            <x-tall-input :field="$field" x-ref="password" />
                            <x-tall-input-error for="password" class="mt-2" wire:keydown.enter="deleteUser" />
                        </x-tall-label>
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-tall-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-tall-secondary-button>

                <x-tall-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-tall-danger-button>
            </x-slot>
        </x-tall-acl-dialog-modal>
    </x-slot>
</x-tall-acl-action-section>
