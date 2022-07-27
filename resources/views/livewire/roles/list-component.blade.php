<div class=" p-5">
    <div class="flex flex-col">
        <div class="recent-activity">
            <div class="w-full py-2">
                <x-slot name="header">
                    <!-- Section Hero -->
                    @include('acl::header', ['label' => 'Roles','url'=>route(config('acl.routes.roles.list'))])
                </x-slot>
            </div>
            <div class="flex w-full flex-col">
                <div class="py-2 min-w-full sm:px-6 lg:px-8">
                    <div class="shadow border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" wire:click="sortBy('name')"
                                        class=" px-6 cursor-pointer py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex space-x-2 justify-between">
                                            <span> {{ __('Name') }}</span>
                                            @if ($sort)
                                                @if ($sort == 'name')
                                                    @if ($direction == 'desc')
                                                        <x-icon name="sort-descending" class="w-5 h-5" />
                                                    @else
                                                        <x-icon name="sort-ascending" class="w-5 h-5" />
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" wire:click="sortBy('slug')"
                                        class="px-6 cursor-pointer py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex space-x-2 justify-between">
                                            <span> {{ __('Slug') }}</span>
                                            @if ($sort)
                                                @if ($sort == 'slug')
                                                    @if ($direction == 'desc')
                                                        <x-icon name="sort-descending" class="w-5 h-5" />
                                                    @else
                                                        <x-icon name="sort-ascending" class="w-5 h-5" />
                                                    @endif
                                                @endif
                                            @endif
                                        </div>

                                    </th>
                                    <th scope="col" wire:click="sortBy('created_at')"
                                        class="px-6 cursor-pointer py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex space-x-2 justify-between">
                                            <span> {{ __('Created At') }}</span>
                                            @if ($sort)
                                                @if ($sort == 'created_at')
                                                    @if ($direction == 'desc')
                                                        <x-icon name="sort-descending" class="w-5 h-5" />
                                                    @else
                                                        <x-icon name="sort-ascending" class="w-5 h-5" />
                                                    @endif
                                                @endif
                                            @endif
                                        </div> 
                                    </th>
                                    <th colspan="2" scope="col"
                                        class="px-6 py-3 flex space-x-2 w-full items-center">
                                        <div class="flex-1">
                                            <x-input icon="search" wire:model="search"
                                                placeholder="{{ __('Search...') }}" />
                                        </div>
                                        <x-button icon="plus" positive squared
                                            href="{{ route(config('acl.routes.roles.create')) }}"
                                            label="{{ __('Adicionar') }}" teal flat />
                                    </th>
                                </tr>
                            </thead>
                            <tbody @if (config('acl.user.order')) wire:sortable="updateOrder" @endif
                                class="bg-white divide-y divide-gray-200">
                                @foreach ($models as $model)
                                    <tr
                                        @if (config('acl.user.order')) wire:sortable.item="{{ $model->id }}" @endif>
                                        <td class="flex items-center px-6 py-4 space-x-2">
                                            @if (config('acl.user.order'))
                                                <div wire:sortable.handle class="flex align-middle cursor-move">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <span>{{ $model->name }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-wrap">
                                            {{ $model->slug }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-wrap">
                                            {{ $model->created_at->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td>
                                            <div class="flex px-2 space-x-2 align-middle">
                                                <x-button icon="pencil" sm primary squared
                                                    href="{{ route(config('acl.routes.roles.edit'), $model) }}"
                                                    label="{{ __('Editar') }}" teal />
                                                <x-button
                                                    x-on:confirm="{
                                                    title:'{{ __('ATENÇÃO!') }}',
                                                    description:'{{ sprintf('Deseja realmente excluir o registro - %s', $model->name) }}',
                                                    icon: 'error',
                                                    method: 'kill',
                                                    params: '{{ data_get($model, 'id') }}'
                                                }"
                                                    icon="x" negative sm squared label="{{ __('Deletar') }}"
                                                    teal />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="py-2 px-3" colspan="4">
                                        <div class="w-full">
                                            {{ $models->links() }}
                                        </div>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
