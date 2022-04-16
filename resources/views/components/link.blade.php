<a {{ $attributes->merge([
    'class' => 'text-sm text-blue-700 hover:underline'
]) }}>
    {{ $slot }}
</a>