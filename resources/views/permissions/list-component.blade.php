<x-tall-app-table-filters :tableAttr="$tableAttr" wire:model="isFilterExpanded">
    <x-slot name="filters">
        <label class="block">
            <span>{{ __('Buscar pelo nome do acesso') }}:</span>
            <div class="relative mt-1.5 flex">
                <input
                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Buscar pelo nome do acesso" type="serch" wire:model.debounce.500ms="filters.search" />
                <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <x-tall-icon name="search" />
                </span>
            </div>
        </label>
    </x-slot>
    <table class="is-hoverable w-full text-left">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th
                        class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        {{ __($column->label) }}
                    </th>
                @endforeach
                @if (data_get($tableAttr, 'sortable'))
                    <th
                        class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        |
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>

            @foreach ($models as $model)
                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                    @if ($columns)
                        @foreach ($columns as $column)
                            @if ($actions = array_filter($column->actions))
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    @foreach ($actions as $action)
                                        @if ($action->visible)
                                            <x-tall-link-action :action="$action"  href="{{ route($action->route, $model) }}"/>
                                        @endif
                                    @endforeach
                                </td>
                            @else
                                <td
                                    class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                    {{ data_get($model, $column->name) }}
                                </td>
                            @endif
                        @endforeach
                    @endif
                    {{-- <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        <div class="badge space-x-2.5 px-0 text-primary dark:text-accent-light">
                            <div class="h-2 w-2 rounded-full bg-current"></div>
                            <span>{{ $model->status }}</span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        {{ $model->created_at }}
                    </td> --}}
                    @if (data_get($tableAttr, 'sortable'))
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <x-tall-icon name="arrows-expand" />
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-slot name="pagination">
        {{ $models->links() }}
    </x-slot>
    </x-app-table-filters>
