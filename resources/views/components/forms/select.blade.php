@props(['name', 'options' => null, 'label' => null,])

@if ($label)
<label for="{{ $name }}">{{ $label }}</label>
@endif

<select {{ $attributes->class([
            'form-control',
            ($errors->has($name)) ? 'is-invalid' : '',
        ])
    }} name="{{ $name }}" id="{{ $name }}">
    @if ($options)
    @foreach ($options as $key => $value)
    <option value="{{ $key }}" {{ $name.'_id' == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
    @else
    {{ $slot }}
    @endif
</select>

@error($name)
<span class="invalid-feedback" role="alert">
    {{ $message }}
</span>
@enderror
