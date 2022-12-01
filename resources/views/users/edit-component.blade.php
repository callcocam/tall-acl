<x-tall-app-sections wire:submit.prevent="{{ data_get($formAttr, 'action', 'saveAndStay') }}" :formAttr="$formAttr"
    :path="$path" :model="$model">
    <x-slot name="messages">
        <x-tall-errors :$errors :$fields />
    </x-slot>
    <x-slot name="left">
        <x-tall-app-card-form wire:submit.prevent="updateProfileInformation"
            class="flex flex-col">
            <div class="flex flex-col">
                <div class="avatar  h-full w-full">
                    @if ($this->photo instanceof \Illuminate\Http\UploadedFile)
                        <img class="mask is-squircle" src="{{ $photo->temporaryUrl() }}" alt="avatar" />
                    @else
                        <img class="mask is-squircle" src="{{ data_get($model, 'profile_photo_url') }}"
                            alt="avatar" />
                    @endif
                    <div
                        class="absolute bottom-0 py-2 right-0 left-0 flex items-center justify-between rounded-full bg-white dark:bg-navy-700">

                        <label for="photo"
                            class="btn  px-2 py-1 flex items-center  space-x-2 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <x-tall-icon name="upload" class=" h-4 w-4" /> <span>{{ __('Selecione') }}</span>
                        </label>
                        <input wire:model="photo" id="photo" type="file" hidden />
                        @if ($this->photo instanceof \Illuminate\Http\UploadedFile)
                            <button type="submit" wire:loading.attr="disabled" wire:target="photo"
                                class="btn px-2 px-2 py-1 flex items-center  space-x-2 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <x-tall-icon name="save" class=" h-4 w-4" /> <span>{{ __('Upload') }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </x-tall-app-card-form>
    </x-slot>
    @if ($fields)
        @foreach ($fields as $field)
            <x-tall-label :field="$field">
                <x-dynamic-component component="tall-{{ $field->component }}" :field="$field" />
                <x-tall-input-error :for="$field->key" />
            </x-tall-label>
        @endforeach
    @endif

    
</x-tall-app-sections>
