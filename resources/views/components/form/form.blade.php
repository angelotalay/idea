@props([
    "title",
    "description",
])

<div class="flex min-h-[calc(100dvh-4rem)] items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="space-y-2 text-center">
            <h2 class="text-3xl font-bold tracking-tight">{{ $title }}</h2>
            <p class="text-muted-foreground text-sm font-light">
                {{ $description }}
            </p>
        </div>
        {{ $slot }}
    </div>
</div>
