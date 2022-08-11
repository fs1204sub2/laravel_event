<div>
    <input id="calendar" class="block mt-1 w-full" type="text" name="calendar" value="{{ $currentDate }}"
            wire:change="getDate($event.target.value)" />
            {{-- イベントのtargetのvalueを取得する --}}
    {{-- <x-jet-input id="calendar" class="block mt-1 w-full" type="text" name="calendar" /> --}}
    <div class="flex">
        @foreach ($currentWeek as $day)
            {{ $day }}
        @endforeach
    </div>

    @foreach ($events as $event)
        {{ $event->start_date }} <br>
    @endforeach
</div>



