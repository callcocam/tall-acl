<div class="flex-1 h-screen p-5">
    <div class="flex flex-col">
        <div class="recent-activity block">
            <div class="w-full py-2">
                <x-slot name="header">
                    <!-- Section Hero -->
                    @include('tall-acl::header', [
                        'label' => sprintf('Editar - %s', $model->name),
                        'url' => route(config('acl.routes.roles.list')),
                    ])
                </x-slot>
            </div>
            <div class="flex flex-col">
                <div class="mt-5 md:mt-0">
                    <div class="shadow sm:rounded-md ">
                        <form wire:submit.prevent="saveAndStay">
                            @include('tall-acl::livewire.roles.form')

                            <div class="flex justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 z-10 space-x-2">
                                <x-button wire:loading.attr="disabled" squared negative
                                    href="{{ route(config('acl.routes.roles.list')) }}"
                                    label="{{ __('Voltar para alista') }}" icon="x" />
                                <x-button type="submit" wire:loading.attr="disabled" squared primary
                                    label="{{ __('Sarvar as alterações') }}" icon="check" />
                            </div>
                        </form>

                        @if (method_exists($model, 'permissions'))
                            <div class="hidden sm:block" aria-hidden="true">
                                <div class="py-5">
                                    <div class="border-t border-gray-200"></div>
                                </div>
                            </div>
                            <div class="mt-10 sm:mt-0">
                                <div class="flex flex-col">
                                    <div class="px-4">
                                        <h3 class="text-2xl font-medium leading-6 text-gray-900">
                                            {{ __('Controle de permissõe de acesso ao sistema') }}</h3>
                                        <p class="mt-1 p-2 text-sm text-gray-600">
                                            {{ __('Definir permissões para o papél selecionado') }}
                                        </p>
                                    </div>
                                    <div class="mt-5 md:mt-0">
                                        @livewire('tall-acl::roles.permissions-component', ['model' => $model], key(sprintf('roles-%s', $model->id)))
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
