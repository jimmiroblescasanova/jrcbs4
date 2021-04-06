@props(['type' => 'text', 'label', 'modelName'])

<label for="{{ $modelName }}">{{ $label }}</label>
<input
    type="{{ $type }}"
    wire:model.lazy="{{ $modelName }}"
    id="{{ $modelName }}"
    class="form-control @error($modelName) is-invalid @enderror"
/>
@error($modelName)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
