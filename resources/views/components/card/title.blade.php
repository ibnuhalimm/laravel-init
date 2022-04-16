<div {{ $attributes->merge([
    'class' => 'w-full'
]) }}>
    <h5 class="text-lg text-gray-800 font-bold leading-tight relative">
        {{ $slot }}
    </h5>
</div>