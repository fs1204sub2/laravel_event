<html>
    <head>
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        {{-- Livewireテスト register --}}
        Livewireテスト <span class="text-blue-300">register</span>
        <livewire:register />

        @livewireScripts
    </body>
</html>
