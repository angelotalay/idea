@props([
    "idea",
    "ideaStatus",
    "routeAction",
    "method",
])
<form action="{{ $routeAction }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($idea->exists)
        @method("PATCH")
    @endif

    <div class="space-y-4">
        <div class="flex flex-row items-center justify-between">
            <h3 class="text-2xl font-semibold">
                {{ $idea->exists ? "Edit Idea" : "New Idea" }}
            </h3>
            <button
                class="btn btn-outlined text-red-500"
                id="cancel-idea-modal-button"
                aria-label="Cancel"
                type="button"
            >
                <x-icons.close />
            </button>
        </div>
        <x-form.field
            name="title"
            label="Title"
            type="text"
            :value="$idea->title"
        />
        <x-form.field
            name="description"
            type="textarea"
            label="Description"
            :value="$idea->description"
        />
        {{-- IMAGES --}}
        <div class="space-y-2">
            <x-form.field name="image" type="file" label="Image" />
            @if ($idea->image)
                <div class="space-y-2">
                    <img
                        src="{{ asset("storage/" . $idea->image) }}"
                        alt=""
                        class="h-auto w-full object-cover"
                    />
                    <button
                        class="w-full"
                        type="submit"
                        form="delete-image-form"
                    >
                        Remove Image
                    </button>
                </div>
            @endif

            <x-form.error name="image" />
        </div>
        {{-- STATUS --}}
        <div class="space-y-2">
            <label class="label" for="status">Status</label>
            <div class="flex flex-row justify-center gap-4">
                @foreach ($ideaStatus as $status)
                    <button
                        class="btn btn-outlined status-button"
                        type="button"
                        id="{{ $status->value }}-button"
                        value="{{ $status->value }}"
                    >
                        {{ $status->label() }}
                    </button>
                @endforeach
            </div>
            <x-form.error name="status" />
            <input
                type="text"
                name="status"
                id="status-input"
                hidden
                value="{{ old("status", $idea->status->value) }}"
            />
        </div>
        {{-- STEPS --}}
        <div class="space-y-4">
            <fieldset class="w-full space-y-2">
                <legend class="label">Steps</legend>
                <div class="flex w-full items-center gap-x-2">
                    <input
                        class="input input-bordered flex-1"
                        type="text"
                        id="new-step-input"
                        placeholder="What needs to be done?"
                    />
                    <button
                        type="button"
                        class="btn btn-outlined shrink-0"
                        id="add-step-button"
                        data-test="new-step-button"
                    >
                        <x-icons.close class="rotate-45" />
                    </button>
                </div>
            </fieldset>
            <div id="steps-container" class="space-y-2">
                @if ($idea->steps->count())
                    @foreach ($idea->steps as $step)
                        <div
                            class="repeatable-row border-muted-foreground/30 flex items-center justify-between gap-x-2 rounded-md border p-2"
                        >
                            <input
                                type="hidden"
                                name="steps[]"
                                value="{{ $step->description }}"
                            />

                            <p class="truncate text-sm">
                                {{ $step->description }}
                            </p>

                            <button
                                type="button"
                                class="btn btn-outlined remove-row-button shrink-0 text-red-500"
                            >
                                Remove
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{-- LINKS --}}
        <div class="space-y-4">
            <fieldset class="w-full space-y-2">
                <legend class="label">Links</legend>
                <div class="flex w-full items-center gap-x-2">
                    <input
                        class="input input-bordered flex-1"
                        type="url"
                        id="new-link-input"
                        placeholder="https://google.com"
                    />
                    <button
                        type="button"
                        class="btn btn-outlined shrink-0"
                        id="add-link-button"
                        data-test="new-link-button"
                    >
                        <x-icons.close class="rotate-45" />
                    </button>
                </div>
            </fieldset>
            <div id="links-container" class="space-y-2">
                @if (count($idea->links ?? []))
                    @foreach ($idea->links as $link)
                        <div
                            class="repeatable-row border-muted-foreground/30 flex items-center justify-between gap-x-2 rounded-md border p-2"
                        >
                            <input
                                type="hidden"
                                name="links[]"
                                value="{{ $link }}"
                            />

                            <a
                                href="{{ $link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="truncate text-sm underline"
                            >
                                {{ $link }}
                            </a>

                            <button
                                type="button"
                                class="btn btn-outlined remove-row-button shrink-0 text-red-500"
                            >
                                Remove
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <hr class="border-t-muted-foreground" />
        <div class="flex justify-center">
            <button
                class="btn btn-primary"
                type="submit"
                data-test="submit-idea-button"
            >
                {{ $idea->exists ? "Edit Idea" : "Create New Idea" }}
            </button>
        </div>
    </div>
</form>
