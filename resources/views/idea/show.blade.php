@props([
    "ideas",
])

<x-layout>
    <div class="mx-auto flex flex-col gap-8 py-8">
        <div class="flex justify-between">
            <a href="{{ route("idea.index") }}"><x-icons.arrow-back /></a>
            <div class="flex items-center gap-x-4">
                <button class="btn btn-outlined">
                    <x-icons.external />
                    Edit
                </button>
                <form
                    method="POST"
                    action="{{ route("idea.destroy", $idea) }}"
                >
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-outlined text-red-500">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col gap-y-4">
            <h1 class="text-5xl font-bold">{{ $idea->title }}</h1>
            <div class="flex flex-row items-center gap-x-4">
                <x-idea.status-label :status="$idea->status->label()">
                    {{ $idea->status->label() }}
                </x-idea.status-label>
                <div class="text-muted-foreground text-sm">
                    {{ $idea->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        <x-card>
            <div class="text-foreground prose prose-invert cursor-pointer">
                {{ $idea->description }}
            </div>
        </x-card>

        @if ($idea->links)
            <div class="flex flex-col gap-y-2">
                <h3 class="text-xl font-bold">Links</h3>
                @foreach ($idea->links as $link)
                    <x-card>
                        <a
                            href="{{ $link }}"
                            class="text-muted-foreground hover:text-primary flex flex-row items-center gap-x-2 text-white"
                            target="_blank"
                        >
                            <x-icons.external />
                            {{ $link }}
                        </a>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
