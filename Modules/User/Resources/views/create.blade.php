<x-app-layout>
    @section('title')
        Tambah User
    @endsection

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                Data User
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div>
                    <x-form.form-group-horizontal>
                        <x-form.label-horizontal>
                            Nama <x-form.required-mark/>
                        </x-form.label-horizontal>
                        <x-form.input-horizontal>
                            <x-form.input type="text" name="name" id="__nameCreateUser" :value="old('name')" autofocus />
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
                            <x-form.input type="text" name="username" id="__usernameCreateUser" :value="old('username')" />
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
                            <x-form.input type="email" name="email" id="__emailCreateUser" :value="old('email')" />
                            @error('email')
                                <x-form.invalid-feedback>{{ $message }}</x-form.invalid-feedback>
                            @enderror
                        </x-form.input-horizontal>
                    </x-form.form-group-horizontal>
                    <x-form.form-group-horizontal>
                        <x-form.label-horizontal>
                            Password <x-form.required-mark/>
                        </x-form.label-horizontal>
                        <x-form.input-horizontal>
                            <x-form.input type="password" name="password" id="__passwordCreateUser" />
                            @error('password')
                                <x-form.invalid-feedback>{{ $message }}</x-form.invalid-feedback>
                            @enderror
                        </x-form.input-horizontal>
                    </x-form.form-group-horizontal>
                    <div class="flex items-center justify-center gap-x-2">
                        <x-button type="reset" color="gray" id="__btnCancelCreateUser">
                            Batal
                        </x-button>
                        <x-button type="submit" color="blue" id="__btnSubmitCreateUser">
                            Simpan Data
                        </x-button>
                    </div>
                </div>
            </form>
        </x-card.body>
    </x-card.card-default>

    <x-modal.modal-small id="__modalConfirmCancelStore">
        <x-modal.header>
            <x-modal.title>
                Konfirmasi
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>
            <p class="mb-4 text-center">
                Apakah anda yakin ingin membatalkan menambah user ini?
            </p>
            <div class="flex items-center justify-center gap-2">
                <x-button type="button" color="gray" id="__btnCancelCancelStore">
                    Batal
                </x-button>
                <x-button-link href="{{ route('user.index') }}" color="red" id="__btnConfirmCancelStore">
                    Ya, Lanjutkan
                </x-button-link>
            </div>
        </x-modal.body>
    </x-modal.modal-small>

    @push('bottom_js')
        <script src="{{ asset('js/user/create/index.js?_=' . rand()) }}"></script>
    @endpush
</x-app-layout>
