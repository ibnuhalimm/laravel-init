<x-app-layout>
    @section('title')
        User Management
    @endsection

    <x-slot name="header">
        User Management
    </x-slot>

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                Data User
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="mb-6">
                <x-button-link href="{{ route('user.create') }}" color="blue">
                    <i class="bi bi-plus-circle"></i>
                    <span class="ml-2">
                        {{ __('Tambah User') }}
                    </span>
                </x-button-link>
            </div>

            <x-auth-session-status class="mb-6" :status="session('success')" />

            <div class="w-full overflow-x-auto">
                <table class="w-full" id="__tableUser">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Hak Akses</th>
                            <th>###</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </x-card.body>
    </x-card.card-default>

    @push('top_css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.6/dist/sweetalert2.min.css">
    @endpush

    @push('bottom_js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.6/dist/sweetalert2.min.js"></script>
        <script src="{{ asset('js/user/index/table.js?_=' . rand()) }}"></script>
    @endpush

</x-app-layout>
