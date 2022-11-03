<form wire:submit.prevent="saveAndStay">
    <x-errors title="We found {errors} validation error(s)" />
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 sm:col-span-2">
                    <x-input wire:model.defer="data.zip" label="{{ __('Codigo Postal') }}"
                        placeholder="{{ __('000000-000') }}" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-input wire:model.defer="data.city" label="{{ __('City') }}"
                        placeholder="{{ __('City') }}" />
                </div>
                <div class="col-span-6 sm:col-span-1">
                    <x-native-select label="{{ __('UF') }}" wire:model.defer="data.state">
                        <option>=={{ __('Selecione') }}==</option>
                        @if ($states = $this->states)
                            @foreach ($states as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        @endif
                    </x-native-select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-input wire:model.defer="data.district" label="{{ __('District') }}"
                        placeholder="{{ __('District') }}" />
                </div>
                <x-input wire:model.defer="data.number" label="{{ __('Number') }}"
                    placeholder="{{ __('Number') }}" />
            </div>

            <div class="col-span-6">
                <x-input wire:model.defer="data.street" label="{{ __('Street') }}"
                    placeholder="{{ __('Street') }}" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-input wire:model.defer="data.complement" label="{{ __('Complement') }}"
                    placeholder="{{ __('Complement') }}" />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <x-input wire:model.defer="data.country" label="{{ __('Country') }}"
                    placeholder="{{ __('Country') }}" />
                <div class="col-span-6">
                    <x-textarea wire:model.defer="data.description" label="{{ __('Description') }}"
                        placeholder="{{ __('Description') }}" />
                </div>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <x-button type="submit" spinner primary>
                {{ __('Save Or Change') }}
            </x-button>
        </div>
    </div>
</form>
