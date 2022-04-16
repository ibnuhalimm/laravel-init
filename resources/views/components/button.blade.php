@props(['color'])

@php
    $color = $color ?? 'primary';
@endphp

@switch($color)
    @case('red')
        <button {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md ring-red-300 bg-red-600 tracking-widest text-xs font-semibold uppercase text-white transition ease-in-out duration-150 hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring disabled:opacity-25'
            ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('green')
        <button {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md ring-green-300 bg-green-600 tracking-widest text-xs font-semibold uppercase text-white transition ease-in-out duration-150 hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring disabled:opacity-25'
            ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('blue')
        <button {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md ring-blue-300 bg-blue-600 tracking-widest text-xs font-semibold uppercase text-white transition ease-in-out duration-150 hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring disabled:opacity-25'
            ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('yellow')
        <button {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md ring-yellow-300 bg-yellow-600 tracking-widest text-xs font-semibold uppercase text-white transition ease-in-out duration-150 hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring disabled:opacity-25'
            ]) }}>
            {{ $slot }}
        </button>
        @break
    @default
        <button {{ $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md ring-gray-300 bg-gray-600 tracking-widest text-xs font-semibold uppercase text-white transition ease-in-out duration-150 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25'
            ]) }}>
            {{ $slot }}
        </button>
@endswitch
