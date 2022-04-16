<div class="min-h-screen flex flex-col items-center py-10 bg-gray-100 sm:justify-center sm:pt-0">
    <div class="mt-5">
        {{ $logo }}
    </div>

    <div class="w-full mt-6 px-6 pt-6 pb-8 bg-white shadow-md overflow-hidden sm:max-w-xs sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
