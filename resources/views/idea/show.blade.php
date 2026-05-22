@props([
    "idea",
    "ideaStatus",
])
<x-layout>
    @vite(["resources/js/modal.js"])
    <div class="mx-auto flex flex-col gap-8 py-8">
        <div class="flex justify-between">
            <a href="{{ route("idea.index") }}"><x-icons.arrow-back /></a>
            <div class="flex items-center gap-x-4">
                <button
                    class="btn btn-outlined"
                    id="edit-idea-button"
                    data-test="edit-idea-button"
                >
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
            @if ($idea->image)
                <div class="overflow-hidden rounded-lg">
                    <img
                        src="{{ asset("storage/" . $idea->image) }}"
                        alt=""
                        class="h-auto w-full object-cover"
                    />
                </div>
            @endif

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
        @if ($idea->steps->count())
            <div class="flex flex-col gap-y-2">
                <h3 class="text-xl font-bold">Actionable Steps</h3>
                @foreach ($idea->steps as $step)
                    <x-card>
                        <form
                            method="POST"
                            action="{{ route("step.update", $step) }}"
                        >
                            @csrf
                            @method("PATCH")
                            <div class="flex items-center gap-x-4">
                                <button
                                    type="submit"
                                    class="text-primary-foreground border-primary {{ $step->completed ? "bg-primary" : "" }} flex size-5 items-center justify-center rounded-lg border"
                                >
                                    &check;
                                </button>
                                <span>
                                    {{ $step->description }}
                                </span>
                            </div>
                        </form>
                    </x-card>
                @endforeach
            </div>
        @endif

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
    <x-modal id="edit-idea-modal">
        <x-form.create-idea-form
            :route-action="route('idea.update', $idea)"
            :idea="$idea"
            :ideaStatus="$ideaStatus"
        />
    </x-modal>
    <form
        method="POST"
        id="delete-image-form"
        action="{{ route("idea.image.destroy", $idea) }}"
    >
        @csrf
        @method("DELETE")
    </form>
</x-layout>
