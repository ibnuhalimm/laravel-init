<div {{ $attributes->merge([
    'class' => 'w-full md:w-1/3 md:p-3 md:text-right',
]) }}>
    <label class="block font-medium text-sm text-gray-700">
        {{ $slot }}
    </label>
</div>