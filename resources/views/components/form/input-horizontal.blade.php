<div {{ $attributes->merge([
    'class' => 'w-full md:w-2/3',
]) }}>
    <div class="w-full md:w-4/5">
        {{ $slot }}
    </div>
</div>