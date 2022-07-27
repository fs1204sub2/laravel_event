<div style="text-align: center">
    <button wire:click="increment">+</button>
    <h1>{{ $count }}</h1>
    <div class="mb-8"></div>

    こんにちは、{{ $name }}さん
    <input wire:model="name" type="text">
    {{-- <input wire:model.debounce.2000ms="name" type="text"> --}}
    {{-- <input wire:model.lazy="name" type="text"> --}}
    {{-- <input wire:model.defer="name" type="text"> --}}
    <br>
    <button wire:mouseover="mouseOver">
        マウスを合わせて
    </button>
</div>
