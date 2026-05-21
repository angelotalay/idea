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

<x-layout title="Ideas">
    <div class="flex w-full flex-col gap-6">
        <section class="space-y-2">
            <h1 class="text-3xl">Your Ideas</h1>
            <p class="text-muted-foreground text-sm">
                Capture your thoughts. Make a plan.
            </p>
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
                    <div class="flex flex-col gap-4">
                        <a href="ideas/{{ $idea->id }}">
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
</x-layout>
