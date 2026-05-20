@props([
    "label",
    "name",
    "type" => "text",
])

<div>
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="input input-bordered w-full"
        {{ $attributes }}
        value="{{ old($name) }}"
    />
    @error($name)
        <p class="error">{{ $message }}</p>
    @enderror
</div>
