<x-layouts.auth-layout>
    @auth
        <div>
            <div class="greeting">Hi, <strong>{{ Auth::user()->getName() }}</strong>!</div>
        </div>
    @else
        <x-auth.signin-form />
    @endauth
</x-layouts.auth-layout>
