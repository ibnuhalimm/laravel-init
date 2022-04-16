<x-app-layout>
    @section('title')
        Dashboard
    @endsection

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="max-w-7xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                You're logged in!
            </div>
        </div>
    </div>
</x-app-layout>
