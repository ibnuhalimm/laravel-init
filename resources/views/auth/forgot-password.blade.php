<x-guest-layout>
    @section('title')
        Forgot Password
    @endsection

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}" class="h-12 xl:h-14 w-auto">
            </a>
        </x-slot>

        <x-auth-title>
            Forgot Password
        </x-auth-title>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your username and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <x-label for="username" :value="__('Username')" />
                <x-input type="text" name="username" id="username" class="block mt-1 w-full" :value="old('username')" required autofocus />
            </div>
            <div class="flex flex-row items-center justify-between gap-x-4 mt-4">
                <div class="w-1/2 text-center">
                    <x-link href="{{ route('login') }}">
                        {{ __('Back to login') }}
                    </x-link>
                </div>
                <div class="w-1/2">
                    <x-button type="submit" color="blue" class="block w-full">
                        {{ __('Send Link') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
