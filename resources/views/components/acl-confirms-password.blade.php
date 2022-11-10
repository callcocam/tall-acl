@props(['title' => __('Confirm Password'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span {{ $attributes->wire('then') }} x-data x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);">
    {{ $slot }}
</span>

@once
    <x-tall-acl-dialog-modal wire:model="confirmingPassword">
        <x-slot name="title">
            {{ $title }}
        </x-slot>

        <x-slot name="content">
            {{ $content }}

            <div class="mt-4" x-data="{}"
                x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
                @if ($field = field(__('Confirmable Password'), 'confirmable_password'))
                    <x-tall-input :field="$field" x-ref="confirmable_password" wire:model.defer="confirmablePassword"
                        wire:keydown.enter="confirmPassword" />
                    <x-tall-input-error for="confirmable_password" class="mt-2" />
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-secondary-button wire:click="stopConfirmingPassword" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-tall-secondary-button>

            <x-tall-button class="ml-3" dusk="confirm-password-button" wire:click="confirmPassword"
                wire:loading.attr="disabled">
                {{ $button }}
            </x-tall-button>
        </x-slot>
    </x-tall-acl-dialog-modal>
@endonce
