<x-tall-acl-form-section submit="updateProfileInformation"
    class="grid grid-cols-1 gap-4 sm:grid-cols-6 md:grid-cols-12">
    <!-- Profile Photo -->
    <!-- Name -->
    @if ($field = field('Full Name', 'name')->span(6))
        <x-tall-label for="name" :field="$field">
            <x-tall-input :field="$field" />
            <x-tall-input-error for="name" class="mt-2" />
        </x-tall-label>
    @endif
    @if ($field = email('Email Address')->span(6))
        <x-tall-label for="email" :field="$field">
            <x-tall-input :field="$field" />
            <x-tall-input-error for="email" class="mt-2" />
        </x-tall-label>
    @endif
    <!-- Email -->
    <div class="col-span-6 sm:col-span-12">
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
            !$this->user->hasVerifiedEmail())
            <p class="text-sm mt-2">
                {{ __('Your email address is unverified.') }}
                <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900"
                    wire:click.prevent="sendEmailVerification">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>
            @if ($this->verificationLinkSent)
                <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        @endif
    </div>
    <x-slot name="actions">
        <x-tall-acl-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-tall-acl-action-message>
        <x-tall-button type="submit" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Update Profilo') }}
        </x-tall-button>
    </x-slot>
</x-tall-acl-form-section>
