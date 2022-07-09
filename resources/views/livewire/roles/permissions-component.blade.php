<form wire:submit.prevent="saveAndStay">
    <x-errors title="We found {errors} validation error(s)" />
    <div class="shadow sm:rounded-md">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            @if ($permissions = $this->permissions)
                <fieldset class="flex flex-col">
                    <div class="mt-4 space-y-4 grid grid-cols-3">
                        @foreach ($permissions as $permission)
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <x-checkbox id="{{ $permission->id }}" left-label="{{ $permission->name }}"
                                     value="{{ $permission->id }}"   wire:model.defer="data.permissions.{{ $permission->id }}" />
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
