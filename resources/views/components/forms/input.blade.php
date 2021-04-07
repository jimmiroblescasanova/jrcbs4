@props(['type' => 'text', 'name', 'value' => null])

<label for="{{ $name }}">{{ $slot }}</label>
<input
    type="{{ $type }}"
    id="{{ $name }}"
    name="{{ $name }}"
    {{ $attributes->except('class') }}
    value="{{ old($name, $value) }}"
    class="form-control @error($name) is-invalid @enderror"
/>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
