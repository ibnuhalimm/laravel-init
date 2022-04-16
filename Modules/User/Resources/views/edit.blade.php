<x-app-layout>
    @section('title')
        Edit User
    @endsection

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                Data User
            </x-card.title>
        </x-card.header>
        <x-card.body>

            @error('id')
                <div class="max-w-xl mx-auto mb-4">
                    <x-auth-session-error :status="$message"/>
                </div>
            @enderror

            <form action="{{ route('user.update', [ 'user' => $user ]) }}" method="POST">
                @csrf

                <div>
                    <x-form.form-group-horizontal>
                        <x-form.label-horizontal>
                            Nama <x-form.required-mark/>
                        </x-form.label-horizontal>
                        <x-form.input-horizontal>
                            <x-form.input type="text" name="name" id="__nameEditUser" :value="old('name') ?? $user->name" autofocus />
                            @error('name')
                                <x-form.invalid-feedback>{{ $message }}</x-form.invalid-feedback>
                            @enderror
                        </x-form.input-horizontal>
                    </x-form.form-group-horizontal>
                    <x-form.form-group-horizontal>
                        <x-form.label-horizontal>
                            Username <x-form.required-mark/>
                        </x-form.label-horizontal>
                        <x-form.input-horizontal>
                            <x-form.input type="text" name="username" id="__usernameEditUser" :value="old('username') ?? $user->username" />
                            @error('username')
                                <x-form.invalid-feedback>{{ $message }}</x-form.invalid-feedback>
                            @enderror
                        </x-form.input-horizontal>
                    </x-form.form-group-horizontal>
                    <x-form.form-group-horizontal>
                        <x-form.label-horizontal>
                            Email <x-form.required-mark/>
                        </x-form.label-horizontal>
                        <x-form.input-horizontal>
                            <x-form.input type="email" name="email" id="__emailEditUser" :value="old('email') ?? $user->email" />
                            @error('email')
                                <x-form.invalid-feedback>{{ $message }}</x-form.invalid-feedback>
                            @enderror
                        </x-form.input-horizontal>
                    </x-form.form-group-horizontal>
                    <div class="flex items-center justify-center gap-x-2">
                        <x-button type="reset" color="gray" id="__btnCancelEditUser">
                            Batal
                        </x-button>
                        <x-button type="submit" color="blue" id="__btnSubmitEditUser">
                            Simpan Data
                        </x-button>
                    </div>
                </div>
            </form>
        </x-card.body>
    </x-card.card-default>

    <x-modal.modal-small id="__modalConfirmCancelUpdate">
        <x-modal.header>
            <x-modal.title>
                Konfirmasi
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>
            <p class="mb-4 text-center">
                Apakah anda yakin ingin membatalkan menyimpan data user ini?
            </p>
            <div class="flex items-center justify-center gap-2">
                <x-button type="button" color="gray" id="__btnCancelCancelUpdate">
                    Batal
                </x-button>
                <x-button-link href="{{ route('user.index') }}" color="red" id="__btnConfirmCancelUpdate">
                    Ya, Lanjutkan
                </x-button-link>
            </div>
        </x-modal.body>
    </x-modal.modal-small>

    @push('bottom_js')
        <script src="{{ asset('js/user/edit/index.js?_=' . rand()) }}"></script>
    @endpush
</x-app-layout>
