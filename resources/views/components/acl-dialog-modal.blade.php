@props(['id' => null, 'maxWidth' => null])

<x-tall-acl-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>
    <div class="my-4 mt-4 h-px bg-slate-200 dark:bg-navy-500"></div>
    <div class="flex flex-row justify-end px-6 py-4 text-right">
        {{ $footer }}
    </div>
</x-tall-acl-modal>
