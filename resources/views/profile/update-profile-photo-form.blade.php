<x-tall-acl-form-section submit="updateProfileInformation">
    <!-- Profile Photo -->

    <div class="col-span-12">
        <div class=" flex flex-col justify-content-center w-full">
            @if ($this->photo instanceof \Illuminate\Http\UploadedFile)
                <img class="mx-auto rounded-full h-48 w-48" src="{{ $photo->temporaryUrl() }}" alt="avatar" />
            @else
                <img class="mx-auto rounded-full h-48 w-48" src="{{ data_get($form_data, 'profile_photo_url') }}" alt="avatar" />
            @endif
            <div
                class="flex items-center justify-between rounded-full bg-white dark:bg-navy-700">

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
</x-tall-acl-form-section>
