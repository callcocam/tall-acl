<form wire:submit.prevent="saveAndStay">
    <x-tall-errors title="We found {errors} validation error(s)" />
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
            @if ($roles = $this->roles)
                <fieldset>
                    <legend
                        class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                        {{ __('Selecione os papèis') }}</legend>
                    @foreach ($roles as $role)
                        <label class="inline-flex items-center space-x-2">
                            <input value="{{ $role->id }}" wire:model.defer="form_data.access.{{ $role->id }}"
                                class="form-checkbox is-outline h-5 w-5 rounded border-slate-400/70 before:bg-slate-500 checked:border-slate-500 hover:border-slate-500 focus:border-slate-500 dark:border-navy-400 dark:before:bg-navy-200 dark:checked:border-navy-200 dark:hover:border-navy-200 dark:focus:border-navy-200"
                                type="checkbox" id="{{ $role->id }}" left-label="{{ $role->name }}" />
                            <p>{{ $role->name }}</p>
                        </label>
                    @endforeach
                </fieldset>
            @endif
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button type="submit" spinner primary squared>
                {{ __('Save Or Change') }}
            </button>
        </div>
    </div>
</form>
