<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Care +</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="{{ asset ('assets/js/tailwind.config.js') }}"></script>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>

<body class="bg-gray-50">

    <div class="flex flex-col justify-between">
        <x-sidebar>
        </x-sidebar>
        <div class="fixed ml-56 w-[calc(100%-14rem)] bg-gray-50">
    <div class="w-full bg-gray-50 border-gray-200 text-gray-800 border-b text-lg font-bold py-3 px-6">
        {{ $title }}
    </div>
    <div class="overflow-y-auto h-[calc(100vh-50px)] w-full ">
        {{ $slot }}
    </div>
</div>

    </div>

    @isset($modal)
    {{ $modal }}
    @endisset


</body>

</html>