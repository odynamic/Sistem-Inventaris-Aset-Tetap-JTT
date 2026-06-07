<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Inventaris Palikanci' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="icon" href="/favicon.ico">
</head>

<body x-data="{ openSidebar: true }" class="bg-[#F5F6FA] font-sans">

    <div class="flex">

        @if(auth()->user()->role === 'admin')
            <x-sidebar.admin />
        @else
            <x-sidebar.user />
        @endif

        <div class="flex-1 min-h-screen flex flex-col">

            <x-header.topbar />

            <main class="p-8">
                {{ $slot }}
            </main>

        </div>

    </div>

    @livewireScripts
</body>
</html>
