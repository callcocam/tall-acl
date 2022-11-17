<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>
    <x-tall-acl.teams.section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-tall-acl.teams.section-title>

    <div class="mt-5">
        <div class="px-1 py-5">
            {{ $content }}
        </div>
    </div>
</div>