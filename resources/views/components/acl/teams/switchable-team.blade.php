@props(['team', 'component' => 'jet-dropdown-link'])

<form method="POST" action="{{ route('current-team.update') }}" x-data>
    @method('PUT')
    @csrf
    <!-- Hidden Team ID -->
    <input type="hidden" name="team_id" value="{{ $team->id }}">
    <x-tall-acl.teams.user-link href="#" x-on:click.prevent="$root.submit();">
        <x-slot name="icon">
            @if (Auth::user()->isCurrentTeam($team))
                <svg class=" h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            @else
                <svg class=" h-5 w-5 text-gray-400" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            @endif
        </x-slot>
        <div class="truncate">{{ $team->name }}</div>
    </x-tall-acl.teams.user-link>
</form>
