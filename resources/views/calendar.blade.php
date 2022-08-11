{{-- layouts/app の top ~ <body> をコピー&ペースト  --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        カレンダー
        {{-- flatpickr で日付も選びたい manager/events/create.blade.php からコピー --}}
        {{-- <div class="mt-4">
            <x-jet-label for="event_date" value="イベント日付" /> --}}

            {{-- <x-jet-input id="event_date" class="block mt-1 w-full" type="text" name="event_date" required/> --}}
            {{-- <x-jet-input id="calendar" class="block mt-1 w-full" type="text" name="calendar"/> --}}
        {{-- </div> --}}

        @livewire('calendar') {{-- コンポーネント読み込み --}}

        @livewireScripts
    </body>
</html>
