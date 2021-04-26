@props(['route' => '#', 'active' => false, 'title'])

<li class="nav-item">
    <a href="{{ $route }}" class="nav-link {{ $active ? 'active' : '' }}">
        <i {{ $attributes->class('nav-icon') }}></i>
        <p>{{ $title ?? $slot }}</p>
    </a>
</li>
