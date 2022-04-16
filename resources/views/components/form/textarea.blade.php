<textarea {{ $attributes->merge([
    'class' => 'mt-1 w-full px-3 py-2 rounded-md shadow-sm outline-none border border-solid border-gray-300 resize-none text-sm focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 read-only:bg-gray-100'
]) }}>{{ $slot }}</textarea>