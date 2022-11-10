<x-tall-acl-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-slate-600 dark:text-navy-100">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Finish enabling two factor authentication.') }}
                @else
                    {{ __('You have enabled two factor authentication.') }}
                @endif
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-slate-600 dark:text-navy-100">
            <p>
                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-slate-600 dark:text-navy-100">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                        @else
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-slate-600 dark:text-navy-100">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        @if ($field = field(__('Code'), 'code'))
                            <x-tall-label for="code" :field="$field">
                                <x-tall-input :field="$field" inputmode="numeric" autofocus
                                    autocomplete="one-time-code" wire:model.defer="code"
                                    wire:keydown.enter="confirmTwoFactorAuthentication" />
                                <x-tall-input-error for="code" class="mt-2" wire:keydown.enter="deleteUser" />
                            </x-tall-label>
                        @endif
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-slate-600 dark:text-navy-100">
                    <p class="font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (!$this->enabled)
                <x-tall-acl-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-tall-button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-tall-button>
                </x-tall-acl-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-tall-acl-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-tall-secondary-button class="mr-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-tall-secondary-button>
                    </x-tall-acl-confirms-password>
                @elseif ($showingConfirmation)
                    <x-tall-acl-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-tall-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Confirm') }}
                        </x-tall-button>
                    </x-tall-acl-confirms-password>
                @else
                    <x-tall-acl-confirms-password wire:then="showRecoveryCodes">
                        <x-tall-secondary-button class="mr-3">
                            {{ __('Show Recovery Codes') }}
                        </x-tall-secondary-button>
                    </x-tall-acl-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-tall-acl-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-tall-secondary-button wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-tall-secondary-button>
                    </x-tall-acl-confirms-password>
                @else
                    <x-tall-acl-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-tall-danger-button wire:loading.attr="disabled">
                            {{ __('Disable') }}
                        </x-tall-danger-button>
                    </x-tall-acl-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-tall-acl-action-section>
