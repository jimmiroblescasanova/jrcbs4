@props(['type' => 'text', 'name'])

<label for="{{ $name }}">{{ $slot }}</label>
<input
    type="{{ $type }}"
    id="{{ $name }}"
    name="{{ $name }}"
    {{ $attributes->except('class') }}
    class="form-control @error($name) is-invalid @enderror"
/>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
