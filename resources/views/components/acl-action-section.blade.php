<div {{ $attributes->merge(['class' => 'col-span-12']) }}>
    <x-tall-acl-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-tall-acl-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 shadow sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
