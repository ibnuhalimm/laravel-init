@props(['status'])

@if ($status)
    <div {{ $attributes->merge([
        'class' => 'rounded-md px-4 py-2 bg-red-50 border border-solid border-red-600'
        ]) }}>
        <div class="font-medium text-sm text-red-600">
            {{ $status }}
        </div>
    </div>
@endif
