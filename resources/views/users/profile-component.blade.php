<div class="col-span-12">
    <div class="flex flex-col">
        <div class="p-2">
            <div class="px-4 sm:px-0">
                <h3 class="text-2xl font-medium leading-6 text-gray-900">{{ __('Perfil') }}</h3>
                <p class="mt-1 text-sm">
                    {{ __('Essas informações serão exibidas publicamente, portanto, tome cuidado com o que você compartilha.') }}
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0">
            <form wire:submit.prevent="saveAndStay">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-4 sm:col-span-2">
                                @if ($field = form('name', $fields))
                                    <x-tall-label :field="$field">
                                        <x-dynamic-component component="tall-{{ $field->component }}"
                                            :field="$field" />
                                        <x-tall-input-error :for="$field->key" />
                                    </x-tall-label>
                                @endif
                            </div>
                            <div class="col-span-4 sm:col-span-2">
                                @if ($field = form('email', $fields))
                                    <x-tall-label :field="$field">
                                        <x-dynamic-component component="tall-{{ $field->component }}"
                                            :field="$field" />
                                        <x-tall-input-error :for="$field->key" />
                                    </x-tall-label>
                                @endif
                            </div>
                        </div>
                        {{-- incluir uma template blade na resources/views/includes/user.blade.php --}}
                        {{-- para campos adicionais --}}
                        @includeIf('includes.users')

                        <div class="grid grid-cols-6 gap-4">

                            @if ($model->exists)
                                <div class="col-span-4 sm:col-span-2">
                                    @if ($field = form('name', $fields))
                                        <x-tall-label :field="$field">
                                            <x-dynamic-component component="tall-{{ $field->component }}"
                                                :field="$field" />
                                            <x-tall-input-error :for="$field->key" />
                                        </x-tall-label>
                                    @endif
                                </div>
                                <div class="col-span-4">
                                    <div class="grid grid-cols-2  gap-y-3 gap-x-4">
                                        <div class="col-span-1">
                                            @if ($field = form('name', $fields))
                                                <x-tall-label :field="$field">
                                                    <x-dynamic-component component="tall-{{ $field->component }}"
                                                        :field="$field" />
                                                    <x-tall-input-error :for="$field->key" />
                                                </x-tall-label>
                                            @endif
                                        </div>
                                        <div class="col-span-1 ">
                                            @if ($field = form('password_confirmation', $fields))
                                                <x-tall-label :field="$field">
                                                    <x-dynamic-component component="tall-{{ $field->component }}"
                                                        :field="$field" />
                                                    <x-tall-input-error :for="$field->key" />
                                                </x-tall-label>
                                            @endif
                                        </div>
                                    </div>
                                    <x-tall-errors only="password|current_password" />
                                </div>
                            @else
                                <div class="col-span-4 sm:col-span-4">
                                    @if ($field = form('password', $fields))
                                        <x-tall-label :field="$field">
                                            <x-dynamic-component component="tall-{{ $field->component }}"
                                                :field="$field" />
                                            <x-tall-input-error :for="$field->key" />
                                        </x-tall-label>
                                    @endif
                                </div>
                                <div class="col-span-4 sm:col-span-2">
                                    @if ($field = form('password_confirmation', $fields))
                                        <x-tall-label :field="$field">
                                            <x-dynamic-component component="tall-{{ $field->component }}"
                                                :field="$field" />
                                            <x-tall-input-error :for="$field->key" />
                                        </x-tall-label>
                                    @endif
                                </div>
                            @endif
                        </div>
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            <div x-data={}>
                                <label class="block text-sm font-medium text-gray-700">
                                    {{ __('Profile Photo') }}
                                </label>
                                <div class="mt-1 flex items-center">
                                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                        @if (data_get($form_data, 'profile_photo_path') instanceof \Livewire\TemporaryUploadedFile)
                                            <img src="{{ data_get($form_data, 'profile_photo_path')->temporaryUrl() }}"
                                                alt="">
                                        @else
                                            @if ($profile_photo_url = \Arr::get($model, 'profile_photo_url'))
                                                <img src="{{ $profile_photo_url }}" alt="{{ $model->name }}">
                                            @else
                                                <svg class="h-full w-full text-gray-300" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            @endif
                                        @endif
                                    </span>
                                    <input hidden x-ref="profile_photo_path" type="file" name="profile_photo_path"
                                        id="profile_photo_path" wire:model.lazy="data.profile_photo_path">
                                    <label for="profile_photo_path"
                                        class="ml-5 cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Change Photo') }}
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div>
                            @if ($field = form('description', $fields))
                                <x-tall-label :field="$field">
                                    <x-dynamic-component component="tall-{{ $field->component }}" :field="$field" />
                                    <x-tall-input-error :for="$field->key" />
                                </x-tall-label>
                            @endif
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" spinner primary squared>
                            {{ __('Save Or Change') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if ($basic)
        @if (method_exists($model, 'address'))
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                <div class="flex flex-col">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-2xl font-medium leading-6 text-gray-900">
                                {{ __('Cadastrar ou atualizar endreços') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Informe o endreço do usuário selecionado') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0">
                        @livewire('tall::users.address-component', ['model' => $model], key($model->id))
                    </div>
                </div>
            </div>
        @endif

        @if (method_exists($model, 'roles'))
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="mt-10 sm:mt-0">
                <div class="flex flex-col md:gap-6">
                    <div>
                        <div class="p-2">
                            <h3 class="text-2xl font-medium leading-6 text-gray-900">
                                {{ __('Controle de acesso ao sistema') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Definir papeis para o usuário selecionado') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        @livewire('tall::users.roles-component', ['model' => $model], key(sprintf('roles-%s', $model->id)))
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
