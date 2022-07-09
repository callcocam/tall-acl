<div class="px-4 py-5 bg-white space-y-6">
    <div class="md:grid md:grid-cols-12 gap-y-3 gap-x-4">
        <div class="col-span-12 ">
            <x-input wire:model.defer="data.name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}" />
        </div>
        <div class="col-span-12 ">
            <x-input wire:model.defer="data.email" label="{{ __('E-Mail') }}" placeholder="{{ __('E-Mail') }}" />
        </div>
        @if ($model->exists)
            <div class="col-span-4 ">
                <x-input type="password" wire:model.defer="data.current_password" label="{{ __('Current Password') }}"
                    placeholder="{{ __('Current Password') }}" />
            </div>
            <div class="col-span-8">
                <div class="grid grid-cols-2  gap-y-3 gap-x-4">
                    <div class="col-span-1">
                        <x-input type="password" wire:model.defer="data.password" label="{{ __('New Password') }}"
                            placeholder="{{ __('New Password') }}" />
                    </div>
                    <div class="col-span-1 ">
                        <x-input type="password" wire:model.defer="data.password_confirmation"
                            label="{{ __('Password Confirmation') }}"
                            placeholder="{{ __('Password Confirmation') }}" />
                    </div>
                </div>
                <x-errors only="password|current_password" />
            </div>
        @else
            <div class="col-span-6 ">
                <x-input type="password" wire:model.defer="data.password" label="{{ __('Password') }}"
                    placeholder="{{ __('Password') }}" />
            </div>
            <div class="col-span-6 ">
                <x-input type="password" wire:model.defer="data.password_confirmation"
                    label="{{ __('Password Confirmation') }}" placeholder="{{ __('Password Confirmation') }}" />
            </div>
        @endif
        <div class="col-span-12 flex items-center">
            <div class="my-2 flex space-x-3 h-full w-full items-center">
                <div>
                    <x-radio lg id="left-label" left-label="{{ __('PUBLICADO') }}" value="published"
                        wire:model.defer="data.status_id" />
                </div>
                <div>
                    <x-radio lg id="right-label" label="{{ __('RASCUNHO') }}" value="draft"
                        wire:model.defer="data.status_id" />
                </div>
            </div>
        </div>
    </div>
</div>
