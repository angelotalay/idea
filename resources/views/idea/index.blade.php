@php
    use App\IdeaStatus;
    use App\Models\Idea;
    use Illuminate\Database\Eloquent\Collection;
@endphp

@props([
    "ideas",
    "statuses",
    "statusCounts",
])

@php
    /** @var Collection<int, Idea> $ideas */
    /** @var Collection<int, IdeaStatus> $statuses */
@endphp

@vite(["resources/js/modal.js"])
<x-layout title="Ideas">
    <div class="flex w-full flex-col gap-6">
        <section class="space-y-2">
            <h1 class="text-3xl">Your Ideas</h1>
            <p class="text-muted-foreground text-sm">
                Capture your thoughts. Make a plan.
            </p>
            <button class="h-28 w-full md:h-36" id="create-idea-button">
                <x-card class="flex h-full w-full items-center justify-center">
                    <p class="w-full text-xl">What's the idea?</p>
                </x-card>
            </button>

            <div class="flex flex-row gap-2">
                <a
                    href="/ideas"
                    class="btn {{ request()->has("status") ? "btn-outlined" : "" }}"
                >
                    All
                </a>
                @foreach ($statuses as $status)
                    <a
                        href="/ideas?status={{ $status->value }}"
                        class="btn {{ request("status") === $status->value ? "" : "btn-outlined" }}"
                    >
                        {{ $status->label() }}
                        <span class="pl-3 text-xs">
                            {{ $statusCounts->get($status->value) }}
                        </span>
                    </a>
                @endforeach
            </div>
        </section>
        <div
            class="text-muted-foreground grid grid-cols-1 gap-4 md:grid-cols-2"
        >
            @forelse ($ideas as $idea)
                <x-card>
                    <div class="flex flex-col justify-center gap-4">
                        @if ($idea->image)
                            <div
                                class="-t-4 -mx-4 -mt-4 mb-4 overflow-hidden rounded-t-lg"
                            >
                                <img
                                    src="{{ asset("storage/" . $idea->image) }}"
                                    alt=""
                                    class="h-auto w-full object-cover"
                                />
                            </div>
                        @endif

                        <a href="/ideas/{{ $idea->id }}">
                            <h3 class="text-3xl text-white hover:underline">
                                {{ $idea->title }}
                            </h3>
                        </a>
                        <div>
                            <x-idea.status-label
                                status="{{$idea->status->label()}}"
                            >
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>
                        <p class="line-clamp-3">{{ $idea->description }}</p>
                        <p>{{ $idea->created_at->diffForHumans() }}</p>
                    </div>
                </x-card>
            @empty
                <x-card>
                    <p>No ideas at this time.</p>
                </x-card>
            @endforelse
        </div>
    </div>
    <x-modal id="create-idea-modal">
        <x-form.create-idea-form
            :idea="new Idea()"
            :idea-status="$statuses"
            :route-action="route('idea.store')"
        />
    </x-modal>
</x-layout>
