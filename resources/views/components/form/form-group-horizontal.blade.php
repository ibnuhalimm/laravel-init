<div {{ $attributes->merge([
    'class' => 'mb-5 flex flex-col items-start justify-between gap-1 md:flex-row'
]) }}>
    {{ $slot }}
</div>