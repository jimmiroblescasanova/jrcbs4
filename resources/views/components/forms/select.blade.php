@props([
    'name',
    'options',
    'select2' => null,
])

<label for="{{ $name }}">{{ $slot }}</label>
<select class="form-control @error($name) is-invalid @enderror {{ $select2 }}"
    name="{{ $name }}"
    id="{{ $name }}"
    >
    <option></option>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
