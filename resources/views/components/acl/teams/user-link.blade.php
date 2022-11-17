<a
    {{ $attributes->merge([
        'class' =>
            'group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600',
    ]) }}>
    @isset($icon)
        {{ $icon }}
    @endisset
    <div>
        <h2
            class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
            {{ $slot }}
        </h2>
        @isset($description)
            <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                {{ $description }}
            </div>
        @endisset
    </div>
</a>
