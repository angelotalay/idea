@props([
    "id",
])
<div
    class="bg-black-50 pointer-events-none fixed inset-0 z-50 flex -translate-x-4 -translate-y-4 items-center justify-center opacity-0 backdrop-blur-md transition-all duration-300"
    id="{{ $id }}"
>
    <x-card>
        {{ $slot }}
    </x-card>
</div>
