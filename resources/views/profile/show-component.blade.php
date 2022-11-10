<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            {{ __('Dashboard') }}
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
            <li class="flex items-center space-x-2">
                <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                    href="#">{{ __('User') }}</a>
                <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewbox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </li>
            <li>{{ __('Profile') }}</li>
        </ul>
    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="col-span-12 lg:col-span-4">
            <div class="card ">
                @livewire('tall::admin.profile.update-profile-photo-form')
            </div>
        </div>
        @endif
        <div class="col-span-12 lg:col-span-8">
            <div class="card">
                <div
                    class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        {{ __('Account Setting') }} {{ $model->name }}
                    </h2>
                </div>
                <div class="p-4 sm:p-5">
                    <div class="">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('tall::admin.profile.update-profile-information-form')

                            <x-jet-section-border />
                        @endif

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-5 sm:mt-0">
                                @livewire('tall::admin.profile.update-password-form')
                            </div>

                            <x-jet-section-border />
                        @endif
                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-10 sm:mt-0">
                                @livewire('tall::admin.profile.two-factor-authentication-form')
                            </div>

                            <x-jet-section-border />
                        @endif

                        <div class="mt-10 sm:mt-0">
                            @livewire('tall::admin.profile.logout-other-browser-sessions-form')
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-jet-section-border />

                            <div class="mt-10 sm:mt-0">
                                @livewire('tall::admin.profile.delete-user-form')
                            </div>
                        @endif
                    </div>
                    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                    {{-- <div>
                        <h3 class="text-base font-medium text-slate-600 dark:text-navy-100">
                            Linked Accounts
                        </h3>
                        <p class="text-xs+ text-slate-400 dark:text-navy-300">
                            Lorem ipsum dolor sit amet consectetur.
                        </p>
                        <div class="flex items-center justify-between pt-4">
                            <div class="flex items-center space-x-4">
                                <div class="h-12 w-12">
                                    <img src="{{ asset('images/200x200.png') }}" alt="logo" />
                                </div>
                                <p class="font-medium line-clamp-1">
                                    Sign In with Google
                                </p>
                            </div>
                            <button
                                class="btn h-8 rounded-full border border-slate-200 px-3 text-xs+ font-medium text-primary hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                Connect
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</main>
