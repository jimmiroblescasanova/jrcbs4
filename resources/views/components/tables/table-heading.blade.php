@props([
    'sortable' => null,
    'direction' => null
])

<th>
    @if ($sortable!=null)
        <a {{ $attributes->except('class') }} style="cursor: pointer;">
            @if ($direction === null)
                <i class="fas fa-sort"></i>
            @elseif($direction === 'asc')
                <i class="fas fa-sort-up"></i>
            @elseif ($direction === 'desc')
                <i class="fas fa-sort-down"></i>
            @endif
            {{ $slot }}
        </a>
    @else
        {{ $slot }}
    @endif
</th>
