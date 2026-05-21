@php
    use App\Models\Idea;
    use App\IdeaStatus;
    $baseClasses = "inline-block rounded-full border px-2 py-1 text-xs font-medium";

    $statusClasses = match ($status) {
        IdeaStatus::PENDING->label() => "bg-yellow-500 text-white",
        IdeaStatus::IN_PROGRESS->label() => "bg-blue-500 text-white",
        IdeaStatus::COMPLETED->label() => "bg-primary text-white",
    };

    $badgeClasses = "{$statusClasses} {$baseClasses}";
@endphp

@props([
    "status" => IdeaStatus::PENDING->label(),
])

<span {{ $attributes(["class" => $badgeClasses]) }}>
    {{ $slot }}
</span>
