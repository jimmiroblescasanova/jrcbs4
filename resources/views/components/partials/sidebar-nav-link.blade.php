@props(['route' => '#', 'active' => false, 'message'])

<li class="nav-item">
    <a href="{{ $route }}" class="nav-link {{ $active ? 'active' : '' }}">
        <i {{ $attributes->class('nav-icon') }}></i>
        <p>{{ $message }}</p>
    </a>
</li>
