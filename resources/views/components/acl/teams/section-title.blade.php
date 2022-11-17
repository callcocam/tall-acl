<div class="flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium  text-slate-700 dark:text-navy-100">{{ $title }}</h3>
        <p class="mt-1 text-sm  text-slate-700 dark:text-navy-100">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
