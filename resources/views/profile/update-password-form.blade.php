<x-tall-acl-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    @if ($field = field(__('Current Password'), 'current_password')->span(4))
        <x-tall-label for="name" :field="$field">
            <x-tall-input :field="$field" />
            <x-tall-input-error for="{{ $field->name }}" class="mt-2" />
        </x-tall-label>
    @endif
    @if ($field = field(__('New Password'), 'password')->span(4))
        <x-tall-label for="password" :field="$field">
            <x-tall-input :field="$field" />
            <x-tall-input-error for="{{ $field->name }}" class="mt-2" />
        </x-tall-label>
    @endif
    @if ($field = field(__('Confirm Password'), 'password_confirmation')->span(4))
        <x-tall-label for="password_confirmation" :field="$field">
            <x-tall-input :field="$field" />
            <x-tall-input-error for="{{ $field->name }}" class="mt-2" />
        </x-tall-label>
    @endif

    <x-slot name="actions">
        <x-tall-acl-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-tall-acl-action-message>

        <x-tall-button type="submit">
            {{ __('Update Password') }}
        </x-tall-button>
    </x-slot>
</x-tall-acl-form-section>
