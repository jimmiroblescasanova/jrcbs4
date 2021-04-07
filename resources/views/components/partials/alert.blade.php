@props(['type' => 'success', 'icon', 'message'])

<div class="alert alert-{{ $type }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon {{ $icon }}"></i> {!! $message !!}
</div>
