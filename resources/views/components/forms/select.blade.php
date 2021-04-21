@props(['name', 'options' => null, 'label' => null])

@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<select class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $name }}">
    @if ($options)
        @foreach ($options as $key => $value)
            <option
            value="{{ $key }}"
            {{ $name.'_id' == $key ? 'selected' : '' }}
            >{{ $value }}</option>
        @endforeach
    @else
        {{ $slot }}
    @endif
</select>

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
