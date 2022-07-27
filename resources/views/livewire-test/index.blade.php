<html>
    <head>
        @livewireStyles
    </head>
    <body>
        Livewireテスト
        <div>
            @if (session()->has('message'))
                <div>
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <livewire:counter />
        {{-- @livewire('counter') という書き方もある --}}

        @livewireScripts
    </body>
</html>
