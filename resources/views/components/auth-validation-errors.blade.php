@props(['errors'])

@if ($errors->any())
    <div {{ $attributes->merge([
        'class' => 'rounded-md px-4 py-2 bg-red-50 border border-solid border-red-600'
        ]) }}>
        <div class="text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif
