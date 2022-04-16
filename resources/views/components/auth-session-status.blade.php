@props(['status'])

@if ($status)
    <div {{ $attributes->merge([
        'class' => 'rounded-md px-4 py-2 bg-green-50 border border-solid border-green-600'
        ]) }}>
        <div class="font-medium text-sm text-green-600">
            {{ $status }}
        </div>
    </div>
@endif
