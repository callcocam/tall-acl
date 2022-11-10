@props(['field'])
<div class="flex flex-col" x-data="{}">
    <span class="text-base font-medium text-slate-600 dark:text-navy-100">{{ $field->label }}</span>
    <div class="avatar mt-1.5 h-20 w-20">
        @if ($this->photo instanceof \Illuminate\Http\UploadedFile)
            <img class="mask is-squircle" src="{{ $this->photo->temporaryUrl() }}" alt="avatar" />
        @else
            <img class="mask is-squircle" src="{{ data_get($this->form_data, $field->alias) }}" alt="avatar" />
        @endif
        <div class="absolute bottom-0 right-0 flex items-center justify-center rounded-full bg-white dark:bg-navy-700">
            <input {{ $attributes->merge($field->attributes) }} x-ref="{{ $field->name }}" />
            <button type="button" x-on:click.prevent="$refs.{{ $field->name }}.click()"
                class="btn h-6 w-6 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewbox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
    </div>
</div>