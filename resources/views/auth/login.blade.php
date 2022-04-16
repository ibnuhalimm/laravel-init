<x-guest-layout>
    @section('title')
        Login
    @endsection

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}" class="h-12 xl:h-14 w-auto">
            </a>
        </x-slot>

        <x-auth-title>
            Login
        </x-auth-title>

        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="username" :value="__('Username')" />
                <x-input type="text" name="username" id="username" class="block mt-1 w-full" :value="old('username')" required autofocus />
            </div>
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input type="password" name="password" id="password" class="block mt-1 w-full" required autocomplete="current-password" />
            </div>
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input type="checkbox" id="remember_me" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex flex-row items-center justify-between gap-x-4 mt-4">
                <div class="w-3/5 text-center">
                    <x-link href="{{ route('password.request') }}">
                        {{ __('Forgot password') }}
                    </x-link>
                </div>
                <div class="w-2/5">
                    <x-button type="submit" color="blue" class="block w-full">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
