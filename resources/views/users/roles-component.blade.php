<form wire:submit.prevent="saveAndStay">
    <x-errors title="We found {errors} validation error(s)" />
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            @if ($roles = $this->roles)
                <fieldset>
                    <legend class="text-base font-medium text-gray-900">{{ __('Selecione os papèis') }}</legend>
                    <div class="mt-4 space-y-4 md:grid md:grid-cols-3">
                        @foreach ($roles as $role)
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <x-checkbox id="{{ $role->id }}" left-label="{{ $role->name }}"
                                        value="{{ $role->id }}"
                                        wire:model.defer="data.access.{{ $role->id }}" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            @endif
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <x-button type="submit" spinner primary squared>
                {{ __('Save Or Change') }}
            </x-button>
        </div>
    </div>
</form>
