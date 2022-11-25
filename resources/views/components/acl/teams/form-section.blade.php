@props(['submit'])

<div {{ $attributes->merge(['class' => 'flex flex-col w-full']) }}>
    <x-tall-acl.teams.section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-tall-acl.teams.section-title>

    <div class=" space-y-4 border-b border-slate-200 p-1 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="px-1">
                <div class="flex flex-col">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-1 py-3 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
