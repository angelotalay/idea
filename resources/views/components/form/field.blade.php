@props([
    "label",
    "name",
    "type" => "text",
    "value" => null
])

<div>
    <label for="{{ $name }}" class="label">{{ $label }}</label>

    @if ($type === "textarea")
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes }}
            class="textarea textarea-bordered w-full"
        >
{{ old($name, $value) }}</textarea
        >
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            class="input input-bordered w-full h-fit"
            {{ $attributes }}
            value="{{ old($name, $value) }}"
        />
    @endif
    <x-form.error  name = "{{$name}}" />
</div>
